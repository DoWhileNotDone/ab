<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ExampleClassTest extends TestCase
{
    use RefreshDatabase;

    public function testExampleClassesCanBeCreatedListedReadUpdatedAndDeleted(): void
    {
        $created = $this->postJson('/api/example-classes', [
            'name' => 'Example 123',
        ])
            ->assertCreated()
            ->assertJsonPath('name', 'Example 123')
            ->assertJsonStructure(['id', 'name'])
            ->json();

        $this->assertIsInt($created['id']);
        $this->assertEqualsCanonicalizing(['id', 'name'], array_keys($created));

        $another = $this->postJson('/api/example-classes', [
            'name' => 'Another Example',
        ])->assertCreated()->json();

        $this->assertNotSame($created['id'], $another['id']);

        $this->getJson('/api/example-classes')
            ->assertOk()
            ->assertJsonCount(2);

        $this->getJson('/api/example-classes/' . $created['id'])
            ->assertOk()
            ->assertJsonPath('id', $created['id'])
            ->assertJsonPath('name', 'Example 123');

        $this->putJson('/api/example-classes/' . $created['id'], [
            'name' => 'Updated Name 456',
        ])->assertOk()
            ->assertJsonPath('name', 'Updated Name 456');

        $this->deleteJson('/api/example-classes/' . $created['id'])
            ->assertNoContent();

        $this->getJson('/api/example-classes/' . $created['id'])
            ->assertNotFound();
    }

    public function testNameMustBeAtMostFiftyAlphanumericOrWhitespaceCharacters(): void
    {
        foreach (
            [
            'Not-valid',
            str_repeat('a', 51),
            ] as $name
        ) {
            $this->postJson('/api/example-classes', ['name' => $name])
                ->assertUnprocessable()
                ->assertJsonValidationErrors('name');
        }

        $this->postJson('/api/example-classes', [
            'name' => str_repeat('a', 50),
        ])->assertCreated();
    }

    public function testMissingExampleClassReturnsJsonNotFound(): void
    {
        $this->get('/api/example-classes/999')
            ->assertNotFound()
            ->assertHeader('content-type', 'application/json');
    }

    public function testExampleClassRequestsAreLogged(): void
    {
        $this->assertSame(
            base_path('.tmp/requests.log'),
            config('logging.channels.requests.path'),
        );

        $logPath = base_path('.tmp/test-requests-' . uniqid('', true) . '.log');
        config(['logging.channels.requests.path' => $logPath]);
        Log::forgetChannel('requests');

        try {
            $this->getJson('/api/example-classes')
                ->assertOk();

            $this->assertFileExists($logPath);
            $contents = file_get_contents($logPath);
            $this->assertNotFalse($contents);
            $this->assertStringContainsString('API request', $contents);
            $this->assertStringContainsString('GET', $contents);
            $this->assertStringContainsString('api/example-classes', $contents);
        } finally {
            if (file_exists($logPath)) {
                unlink($logPath);
            }
        }
    }
}

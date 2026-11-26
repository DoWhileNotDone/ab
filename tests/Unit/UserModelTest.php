<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    public function testPasswordIsHashedAndHiddenFromSerializedUser(): void
    {
        $user = new User([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'password' => 'secret',
        ]);

        $this->assertTrue(Hash::check('secret', $user->password));
        $this->assertArrayNotHasKey('password', $user->toArray());
    }
}

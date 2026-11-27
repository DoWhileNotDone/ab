<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExampleClassRequest;
use App\Models\ExampleClass;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ExampleClassController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(ExampleClass::query()->orderBy('id')->get());
    }

    public function store(ExampleClassRequest $request): JsonResponse
    {
        return response()->json(
            ExampleClass::query()->create($request->validated()),
            Response::HTTP_CREATED,
        );
    }

    public function show(ExampleClass $exampleClass): JsonResponse
    {
        return response()->json($exampleClass);
    }

    public function update(ExampleClassRequest $request, ExampleClass $exampleClass): JsonResponse
    {
        $exampleClass->update($request->validated());

        return response()->json($exampleClass->refresh());
    }

    public function destroy(ExampleClass $exampleClass): Response
    {
        $exampleClass->delete();

        return response()->noContent();
    }
}

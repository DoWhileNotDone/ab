<?php

use App\Http\Controllers\Api\ExampleClassController;
use App\Http\Middleware\LogApiRequests;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json(['status' => 'ok']));

Route::apiResource('example-classes', ExampleClassController::class)
    ->middleware(LogApiRequests::class);

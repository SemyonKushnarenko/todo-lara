<?php

declare(strict_types=1);

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{user_id}/todo-lists', [TodoListController::class, 'getAllByUser']);
    Route::get('/user/{user_id}/todo-lists', [TodoController::class, 'updateTitle']);
});

<?php

declare(strict_types=1);

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{user_id}/todo-lists', [TodoListController::class, 'getAllByUser']);
});

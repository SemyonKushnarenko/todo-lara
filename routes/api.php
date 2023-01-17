<?php

declare(strict_types=1);

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{user_id}/todo-lists', [TodoListController::class, 'getAllByUser']);
    Route::get('/user/{user_id}/todo-list/{todo_list_id}', [TodoListController::class, 'getTodoList']);
    Route::patch('/user/{user_id}/todo-list/{todo_list_id}', [TodoListController::class, 'updateTodoList']);
    Route::post('/todo-list/{todo_list_id}/todo', [TodoController::class, 'createTodo']);
    Route::patch('/todo-list/{todo_list_id}/todo/{todo_id}', [TodoController::class, 'updateTodo']);
    Route::delete('/todo-list/{todo_list_id}/todo/{todo_id}', [TodoController::class, 'deleteTodo']);
});

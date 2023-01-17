<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Resources\TodoListResource;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Exception;

class TodoService
{
    public function __construct(
        private UserService $userService,
    private TodoListService $todoListService
    )
    {
    }

    /**
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws Exception
     * @return array<string>
     */
    public function createTodo(array $todoParams): array
    {
        $userId = (int)$todoParams['user_id'];
        $todoListId = (int)$todoParams['todo_list_id'];
        $this->todoListService->getTodoList(
            $userId,
            $todoListId,
        );

        $todo = Todo::create([
            'todo_list_id' => $todoListId,
            'title' => $todoParams['title'],
            'is_done' => false,
        ]);

        $todoResource = new TodoResource($todo);

        return $todoResource->resolve();
    }

    /**
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws Exception
     * @return array<string>
     */
    public function updateTodo(array $todoParams): array
    {
        $this->todoListService->getTodoList(
            (int)$todoParams['user_id'],
            (int)$todoParams['todo_list_id'],
        );
        $todo = $this->findTodo((int)$todoParams['todo_id']);
        $todo->update([
            'title' => $todoParams['title'],
            'is_done' => $todoParams['is_done'],
        ]);
        $todoResource = new TodoResource($todo);

        return $todoResource->resolve();
    }

    /**
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws Exception
     */
    public function deleteTodo(array $todoParams): void
    {
        $this->todoListService->getTodoList(
            (int)$todoParams['user_id'],
            (int)$todoParams['todo_list_id'],
        );
        $todo = $this->findTodo((int)$todoParams['todo_id']);

        $todo->delete();
    }

    /**
     * @throws NotFoundException
     * @throws ForbiddenException
     * @throws Exception
     */
    private function findTodo(int $todoId): Todo
    {
        $todo = Todo::find($todoId);

        if (!$todo) {
            throw new NotFoundException(
                sprintf('Todo with id %d was not found.', $todoId),
            );
        }

        return $todo;
    }
}

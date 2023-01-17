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
    public function __construct(private UserService $userService)
    {
    }

    /**
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws Exception
     * @return array<string>
     */
    public function updateTodo(array $todoParams): array
    {
        $userId = (int)$todoParams['user_id'];
        $this->userService->getUser($userId);
        $todo = $this->findTodo(
            (int)$todoParams['todo_id'],
            $userId
        );

        $todo->update([
            'title' => $todoParams['title'],
            'is_done' => $todoParams['is_done'],
        ]);

        $todoResource = new TodoResource($todo);

        return $todoResource->resolve();
    }

    /**
     * @throws NotFoundException
     * @throws ForbiddenException
     * @throws Exception
     */
    private function findTodo(int $todoId, int $userId): Todo
    {
        $todo = Todo::find($todoId);

        if (!$todo) {
            throw new NotFoundException(
                sprintf('Todo with id %d was not found.', $todoId),
            );
        }

        if ($todo->todoList->user_id !== $userId) {
            throw new ForbiddenException('You have no permissions.');
        }

        return $todo;
    }
}

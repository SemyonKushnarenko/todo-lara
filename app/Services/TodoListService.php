<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Resources\TodoListResource;
use App\Http\Resources\TodoResource;
use App\Models\TodoList;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TodoListService
{
    public function __construct(private UserService $userService)
    {
    }

    /**
     * @throws NotFoundException
     * @throws Exception
     * @return array<string>
     */
    public function getListsByUser(int $userId): array
    {
        $this->userService->getUser($userId);
        $todoLists = $this->findAllByUser($userId);

        return TodoListResource::collection($todoLists)->resolve();
    }

    /**
     * @throws NotFoundException
     * @throws ForbiddenException
     * @throws Exception
     */
    public function getTodoList(int $userId, int $todoListId): array
    {
        $this->userService->getUser($userId);
        $todoList = $this->findTodoList($todoListId, $userId);
        $todoListResource = new TodoListResource($todoList);

        return $todoListResource->resolve();
    }

    /**
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws Exception
     * @return array<string>
     */
    public function updateTodoList(array $todoListParams): array
    {
        $userId = (int)$todoListParams['user_id'];
        $this->userService->getUser($userId);
        $todoList = $this->findTodoList(
            (int)$todoListParams['todo_list_id'],
            $userId
        );

        $todoList->update([
            'title' => $todoListParams['title'],
            'description' => $todoListParams['description'],
        ]);

        $todoResource = new TodoListResource($todoList);

        return $todoResource->resolve();
    }

    /**
     * @param int $userId
     * @return Collection<int, TodoList>
     * @throws NotFoundException
     */
    private function findAllByUser(int $userId): Collection
    {
        $todoLists = Todolist::where('user_id', $userId)->get();

        if ($todoLists->isEmpty()) {
            throw new NotFoundException(
                sprintf('TodoLists belonging to user with id %d were not found.', $userId),
            );
        }

        return $todoLists;
    }

    /**
     * @throws NotFoundException
     * @throws ForbiddenException
     * @throws Exception
     */
    private function findTodoList(int $todoListId, int $userId): TodoList
    {
        $todoList = Todolist::find($todoListId);

        if (!$todoList) {
            throw new NotFoundException(
                sprintf('TodoList with id %d was not found.', $todoListId),
            );
        }

        if ($todoList->user_id !== $userId) {
            throw new ForbiddenException('You have no permissions.');
        }

        return $todoList;
    }
}

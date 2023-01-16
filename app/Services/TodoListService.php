<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\TodoListResource;
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
}

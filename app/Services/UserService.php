<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;

class UserService
{
    public function getUser(int $userId): UserResource
    {
        return new UserResource($this->findUser($userId));
    }

    /**
     * @throws NotFoundException
     * @throws Exception
     */
    private function findUser(int $userId): User
    {
        $user = User::find($userId);

        if (!$user) {
            throw new NotFoundException(
                sprintf('User with id %d was not found.', $userId),
            );
        }

        return $user;
    }
}

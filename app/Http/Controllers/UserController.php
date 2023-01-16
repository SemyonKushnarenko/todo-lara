<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ApiController
{
    public function __construct(private UserService $userService)
    {
    }

    public function getUser(UserRequest $request): JsonResponse
    {
        $validatedParams = $request->validated();
        try {
            $user = $this->userService->getUser((int)$validatedParams['user_id']);
            return $this->successResponse($user->resolve());
        } catch (NotFoundException $error) {
            return $this->clientErrorsResponse(
                message: $error->getMessage(),
                code: Response::HTTP_NOT_FOUND,
            );
        } catch (Exception) {
            return $this->serverErrorResponse();
        }
    }
}

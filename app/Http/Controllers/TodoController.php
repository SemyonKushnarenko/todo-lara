<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\UserRequest;
use App\Services\TodoListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends ApiController
{
    public function __construct(private TodoService $todoService)
    {
    }

    public function getAllByUser(UserRequest $request): JsonResponse
    {
        $validatedParams = $request->validated();
        try {
            $todoLists = $this->todoService->updateTitle(
                (int)$validatedParams['todo_id']
            );
            return $this->successResponse($todoLists);
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

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends ApiController
{
    public function __construct(private TodoService $todoService)
    {
    }

    public function updateTodo(TodoRequest $request): JsonResponse
    {
        try {
            $todoLists = $this->todoService->updateTodo($request->validated());
            return $this->successResponse($todoLists);
        } catch (NotFoundException $error) {
            return $this->clientErrorsResponse(
                message: $error->getMessage(),
                code: Response::HTTP_NOT_FOUND,
            );
        } catch (ForbiddenException $error) {
            return $this->clientErrorsResponse(
                message: $error->getMessage(),
                code: Response::HTTP_FORBIDDEN,
            );
//        } catch (Exception) {
//            return $this->serverErrorResponse();
        }
    }
}

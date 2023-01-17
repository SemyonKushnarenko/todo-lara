<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Todo\CreateTodoRequest;
use App\Http\Requests\Todo\TodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Services\TodoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends ApiController
{
    public function __construct(private TodoService $todoService)
    {
    }

    public function createTodo(CreateTodoRequest $request): JsonResponse
    {
        try {
            $todoResource = $this->todoService->createTodo($request->validated());
            return $this->successResponse(
                data: $todoResource,
                code: Response::HTTP_CREATED
            );
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
        } catch (Exception) {
            return $this->serverErrorResponse();
        }
    }

    public function updateTodo(UpdateTodoRequest $request): JsonResponse
    {
        try {
            $this->todoService->updateTodo($request->validated());
            return $this->successResponse(code: Response::HTTP_NO_CONTENT);
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
        } catch (Exception) {
            return $this->serverErrorResponse();
        }
    }

    public function deleteTodo(TodoRequest $request): JsonResponse
    {
        try {
            $this->todoService->deleteTodo($request->validated());
            return $this->successResponse(code: Response::HTTP_NO_CONTENT);
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
        } catch (Exception) {
            return $this->serverErrorResponse();
        }
    }
}

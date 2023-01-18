<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\TodoList\CreateTodoListRequest;
use App\Http\Requests\TodoList\TodoListRequest;
use App\Http\Requests\TodoList\UpdateTodoListRequest;
use App\Http\Requests\UserRequest;
use App\Services\TodoListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends ApiController
{
    public function __construct(private TodoListService $todoListService)
    {
    }

    public function createTodoList(CreateTodoListRequest $request): JsonResponse
    {
        try {
            $todoListResource = $this->todoListService->createTodoList($request->validated());
            return $this->successResponse(
                data: $todoListResource,
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

    public function getAllByUser(UserRequest $request): JsonResponse
    {
        $validatedParams = $request->validated();
        try {
            $todoLists = $this->todoListService->getListsByUser((int)$validatedParams['user_id']);
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

    public function getTodoList(TodoListRequest $request): JsonResponse
    {
        $validatedParams = $request->validated();

        try {
            $todoList = $this->todoListService->getTodoList(
                (int)$validatedParams['user_id'],
                (int)$validatedParams['todo_list_id'],
            );
            return $this->successResponse($todoList);
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

    public function updateTodoList(UpdateTodoListRequest $request): JsonResponse
    {
        try {
            $this->todoListService->updateTodoList($request->validated());
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

    public function deleteTodoList(TodoListRequest $request): JsonResponse
    {
        try {
            $this->todoListService->deleteTodoList($request->validated());
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

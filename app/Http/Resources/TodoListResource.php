<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TodoList */
class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'todos' => TodoResource::collection($this->todos),
        ];
    }
}

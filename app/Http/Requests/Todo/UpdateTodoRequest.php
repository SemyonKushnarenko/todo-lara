<?php

declare(strict_types=1);

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'int'],
            'todo_list_id' => ['required', 'int'],
            'todo_id' => ['required', 'int'],
            'title' => ['required', 'string'],
            'is_done' => ['required', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => request()->user_id,
            'todo_id' => request()->todo_id,
            'todo_list_id' => request()->todo_list_id,
        ]);
    }
}

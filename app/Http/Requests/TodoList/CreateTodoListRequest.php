<?php

declare(strict_types=1);

namespace App\Http\Requests\TodoList;

use Illuminate\Foundation\Http\FormRequest;

class CreateTodoListRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => request()->user_id,
        ]);
    }
}

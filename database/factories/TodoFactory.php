<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'todo_list_id' => TodoList::inRandomOrder()->value('id'),
            'title' => $this->faker->text(60),
            'is_done' => $this->faker->boolean(),
        ];
    }
}

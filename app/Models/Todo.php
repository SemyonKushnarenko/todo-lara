<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @return BelongsTo<TodoList, Todo>
     */
    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }
}

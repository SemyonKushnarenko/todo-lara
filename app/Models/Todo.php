<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Todo
 *
 * @property int $id
 * @property int $todo_list_id
 * @property string $title
 * @property int $is_done
 * @property-read TodoList|null $todoList
 * @method static TodoFactory factory(...$parameters)
 * @method static Builder|Todo newModelQuery()
 * @method static Builder|Todo newQuery()
 * @method static Builder|Todo query()
 * @method static Builder|Todo whereId($value)
 * @method static Builder|Todo whereIsDone($value)
 * @method static Builder|Todo whereTitle($value)
 * @method static Builder|Todo whereTodoListId($value)
 * @mixin Eloquent
 */
class Todo extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'title',
        'is_done',
    ];

    /**
     * @return BelongsTo<TodoList, Todo>
     */
    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }
}

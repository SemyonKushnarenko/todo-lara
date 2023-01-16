<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TodoListFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TodoList
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property-read Collection|Todo[] $todos
 * @property-read int|null $todos_count
 * @property-read User|null $user
 * @method static TodoListFactory factory(...$parameters)
 * @method static Builder|TodoList newModelQuery()
 * @method static Builder|TodoList newQuery()
 * @method static Builder|TodoList query()
 * @method static Builder|TodoList whereDescription($value)
 * @method static Builder|TodoList whereId($value)
 * @method static Builder|TodoList whereTitle($value)
 * @method static Builder|TodoList whereUserId($value)
 * @mixin Eloquent
 */
class TodoList extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @return BelongsTo<User, TodoList>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Todo>
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $id
 * @property mixed $question_id
 * @property mixed $user_id
 * @property mixed $like
 * @property mixed $unlike
 */
class Vote extends Model
{
    use HasFactory;

    protected $table = 'votes';

    /**
     * @return BelongsTo<Question, Vote>
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return BelongsTo<User, Vote>
     */
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $question
 * @property mixed $id
 */
class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    //    protected $fillable = ['question'];
    //    protected $guarded = [];

    /**
     * @return HasMany<Vote>
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

}

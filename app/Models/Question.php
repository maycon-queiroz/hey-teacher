<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Builder, Model, Prunable, SoftDeletes};

/**
 * @property int $id
 * @property int $created_by
 * @property string $question
 * @property boolean $draft
 */
class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Prunable;

    protected $table = 'questions';

    protected $casts = [
        'draft' => 'bool',
    ];

    //    protected $fillable = ['question'];
    //    protected $guarded = [];

    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }

    /**
     * @return HasMany<Vote>
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * @return BelongsTo<User, Question>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function likes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes()->sum('like'));
    }

    public function unlikes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes()->sum('unlike'));
    }

}

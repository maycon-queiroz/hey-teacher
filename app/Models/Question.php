<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $question
 */
class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    //    protected $fillable = ['question'];
    //    protected $guarded = [];

}

<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;

class QuestionController extends Controller
{
    public function __construct(private readonly Question $question)
    {
    }

    public function store()
    {
        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],
        ]);

        $this->question::query()->create($attributes);

        return to_route('dashboard');
    }
}

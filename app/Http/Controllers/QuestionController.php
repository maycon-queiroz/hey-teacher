<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    public function __construct(private Question $question)
    {
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] !== '?') {
                        $fail("Are you sur that is a question? It is missing the question mark in the end.");
                    }
                },
            ]
        ]);

        $this->question::query()->create($attributes);

        return to_route('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Question;
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
            'question' => ['required']
        ]);

        $this->question::query()->create($attributes);

        return to_route('dashboard');
    }
}

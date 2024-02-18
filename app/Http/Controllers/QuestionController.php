<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function __construct(private readonly Question $question)
    {
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],
        ]);

        /** @var User $user */
        $user = user();
        if(is_null($user)){
            return to_route('dashboard');
        }

        $user->questions()
            ->create([
                'question' => $attributes['question'],
                'draft' => true,
            ]);

        return to_route('dashboard');
    }

}

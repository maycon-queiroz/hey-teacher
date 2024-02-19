<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function __construct()
    {
    }

    public function index(): View|RedirectResponse
    {
        $user = user();

        if(is_null($user)) {
            return to_route('dashboard');
        }

        /** @var User $user */
        return view('question.index', ['questions' => $user->questions]);
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

        $user = user();

        if(is_null($user)) {
            return to_route('dashboard');
        }

        /** @var User $user */
        $user->questions()
            ->create([
                'question' => $attributes['question'],
                'draft'    => true,
            ]);

        return back();
    }

}

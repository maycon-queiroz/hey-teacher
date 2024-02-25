<?php

namespace App\Http\Controllers;

use App\Models\{Question};
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request, Response};

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

        $user->questions()
            ->create([
                'question' => $attributes['question'],
                'draft'    => true,
            ]);

        return back();
    }

    public function edit(Question $question): Response
    {
        $this->authorize('update', $question);

        return response()->view('question.edit', compact('question'), 302);
    }

    public function update(Question $question, Request $request): RedirectResponse
    {
        $this->authorize('update', $question);

        request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],
        ]);

        $question->question = $request->get('question');
        $question->save();

        return  to_route('question.index');
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }
}

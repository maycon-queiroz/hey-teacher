<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class PublishController extends Controller
{
    /**
     * @param  Question  $question
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function __invoke(Question $question): RedirectResponse
    {
        $this->authorize('publish', $question);

        $question->draft = false;
        $question->save();

        return back();
    }
}

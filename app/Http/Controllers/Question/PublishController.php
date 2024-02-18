<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    /**
     * @param  Question  $question
     * @return RedirectResponse
     */
    public function __invoke(Question $question): RedirectResponse
    {
        $question->draft = true;
        $question->save();

       return back();
    }
}

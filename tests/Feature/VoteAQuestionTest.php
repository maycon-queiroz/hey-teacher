<?php

use function Pest\Laravel\put;

it("Should be able like a question", function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();

    \Pest\Laravel\actingAs($user);

    put(route('question.like', $question))
    ->assertRedirect();

    \Pest\Laravel\assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);

});

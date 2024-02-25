<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able update a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    put(route('question.update', $question), [
        'question' => 'Updated questions?',
    ])
        ->assertRedirect();

    $question->refresh();

    expect($question->question)
        ->toBe('Updated questions?');
});

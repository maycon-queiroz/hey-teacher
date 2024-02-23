<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to publish a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();

    actingAs($user);

    put(route('question.publish', $question->id))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)
        ->toBeFalse();
});

it('should make sure that only person who has created the question can publish the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['created_by' => $rightUser->id]);

    actingAs($wrongUser);

    put(route('question.publish', $question->id))
        ->assertForbidden();

    actingAs($rightUser);

    put(route('question.publish', $question->id))
        ->assertRedirect();

});

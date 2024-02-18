<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('should be able to publish a question', function () {
    $user = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();

    actingAs($user);

    put(route('question.publish', $question->id))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)
        ->toBeTrue();
});

it('should make sure that only person who has created the question can publish the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question = Question::factory()->create(['created_by' => $rightUser->id]);

    actingAs($wrongUser);

    put(route('question.publish', $question->id))
        ->assertForbidden();

    actingAs($rightUser);

    put(route('question.publish', $question->id))
        ->assertRedirect();

});

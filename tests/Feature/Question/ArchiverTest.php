<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertNotSoftDeleted, assertSoftDeleted, patch};

it('should be able to archive a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    patch(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question->refresh()->deleted_at)->not->toBeNull();
});

it('should be able to archive a question only a person that created', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['created_by' => $rightUser->id]);

    actingAs($wrongUser);

    patch(route('question.archive', $question->id))
        ->assertForbidden();

    actingAs($rightUser);

    patch(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question->refresh()->deleted_at)->not->toBeNull();
});

it('should able restore a questions archived', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    patch(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    patch(route('question.restore', $question))
        ->assertRedirect();

    assertNotSoftDeleted('questions', ['id' => $question->id]);

    expect($question->refresh()->deleted_at)->toBeNull();
});

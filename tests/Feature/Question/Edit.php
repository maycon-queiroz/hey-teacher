<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to open the question to edit', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    get(route('question.edit', $question))
    ->assertRedirect();
});

it('should return a view', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    get(route('question.edit', $question))
        ->assertViewIs('question.edit');
});

it('should make sure that only question with status Draft can be edited', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $questionDraft    = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    get(route('question.edit', $questionNotDraft))
        ->assertForbidden();

    get(route('question.edit', $questionDraft))
        ->assertRedirect();
});

it('should make sure that only person who has created the question can edit the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['created_by' => $rightUser->id]);

    actingAs($wrongUser);

    get(route('question.edit', $question->id))
        ->assertForbidden();

    actingAs($rightUser);

    get(route('question.edit', $question->id))
        ->assertViewIs('question.edit');
});

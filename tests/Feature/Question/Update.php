<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, put};

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

it('should make sure that only question with status Draft can be updated', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $questionDraft    = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    put(
        route('question.update', $questionNotDraft),
        [
            'question' => 'Updated questions?',
        ]
    )
        ->assertForbidden();

    put(
        route('question.update', $questionDraft),
        [
            'question' => 'Updated questions?',
        ]
    )
        ->assertRedirect();
});

it('should make sure that only person who has created the question can update the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['created_by' => $rightUser->id]);

    actingAs($wrongUser);

    put(
        route('question.update', $question->id),
        [
            'question' => 'Updated questions?',
        ]
    )
        ->assertForbidden();

    actingAs($rightUser);

    put(
        route('question.update', $question->id),
        [
            'question' => 'Updated questions?',
        ]
    )
        ->assertRedirect();
});

it("should be able to update a new question bigger than 255 characters", function () {
    // Arrange :: preparar
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    // Act:: Agir
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: verificar
    $request->assertRedirect();
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

it("should check if ends with question mark ? on update", function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors(['question' => 'Are you sur that is a question? It is missing the question mark in the end.']);
});

it('should be at least 10 characters on update', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
});

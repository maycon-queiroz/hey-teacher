<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it("should be able to create a new question bigger than 255 characters", function () {

    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act:: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

it('should create as a draft all the times', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act:: Agir
    post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: verificar
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);
});

it("should check if ends with question mark ?", function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors(['question' => 'Are you sur that is a question? It is missing the question mark in the end.']);
    assertDatabaseCount('questions', 0);
});

it('should be at least 10 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});


test('only authenticated users can create a new question', function (){

    post(route('question.store'), [
        'question' => str_repeat('*', 200) . '?',
    ])->assertRedirect(route('login'));

});

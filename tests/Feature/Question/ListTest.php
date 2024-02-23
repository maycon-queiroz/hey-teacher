<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it("Should be able list all the questions", function () {

    // Arrange :: preparar
    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    // Act:: Agir
    actingAs($user);
    $response = get(route('dashboard'));

    // Assert :: verificar
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

});

<?php

use App\Models\{Question, User};
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

it("Should be able list all the questions", function () {
    // Arrange :: preparar
    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    // Act:: Agir
    actingAs($user);
    $response = get(route('dashboard'));

    // Assert :: verificar
    /** @var Question $question */
    foreach ($questions as $question) {
        $response->assertSee($question->question);
    }
});

it('should paginate the result', function () {
    $user      = User::factory()->create();
    $questions = Question::factory()->count(20)->create();

    // Act:: Agir
    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', fn ($value) => $value instanceof LengthAwarePaginator);
});

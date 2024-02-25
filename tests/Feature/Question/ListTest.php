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
    $user = User::factory()->create();
    Question::factory()->count(20)->create();

    // Act:: Agir
    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', fn ($value) => $value instanceof LengthAwarePaginator);
});

it(
    'should order by like and unlike, most liked question should be at the top, most unliked questions should be in bottom',
    function () {
        $user       = User::factory()->create();
        $secondUser = User::factory()->create();
        Question::factory()->count(5)->create();

        /** @var Question $mostLikedQuestion */
        $mostLikedQuestion = Question::find(2);
        $user->like($mostLikedQuestion);

        /** @var Question $mostUnlikedQuestion */
        $mostUnlikedQuestion = Question::find(5);
        $secondUser->unlike($mostUnlikedQuestion);
        $secondUser->like($mostLikedQuestion);

        // Act:: Agir
        actingAs($user);

        get(route('dashboard'))
            ->assertViewHas('questions', function ($questions) {
                expect($questions->first()->id)->toBe(2)
                    ->and($questions->last()->id)->toBe(5);

                return true;
            });
    }
);

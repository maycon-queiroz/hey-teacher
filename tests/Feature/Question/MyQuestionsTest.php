<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to list all question created by me', function () {

    $wrongUser      = User::factory()->create();
    $wrongQuestions = Question::factory()->for($wrongUser, 'createdBy')->count(10)->create();

    $rightUser      = User::factory()->create();
    $rightQuestions = Question::factory()->for($rightUser, 'createdBy')->count(10)->create();

    actingAs($rightUser);

    $response = get(route('question.index'));

    /** @var Question $q */
    foreach($rightQuestions as $q) {
        $response->assertSee($q->question);
    }

    /** @var Question $q */
    foreach($wrongQuestions as $q) {
        $response->assertDontSee($q->question);
    }
});

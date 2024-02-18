<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('should be able to publish a question', function(){
    $user = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    put(route('question.publish',$question->id))
    ->assertRedirect();

    $question->refresh();

    expect($question->draft)
        ->toBeTrue();

});

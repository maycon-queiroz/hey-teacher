<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to search a question by text', function () {
    $user = User::factory()->create();
    Question::factory()->create(['question' => 'has something else?']);
    Question::factory()->create(['question' => 'has question here?']);

    actingAs($user);
    $response = get(route('dashboard', ['search' => 'question']));

    $response->assertDontSee('has something else?');
    $response->assertSee('has question here?');

});

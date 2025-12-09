<?php

use App\Models\Chirp;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    Chirp::factory()
        ->recycle($this->user)
        ->create([
            'message' => 'hello'
        ]);
    Chirp::factory()->create([
        'message' => 'hello world'
    ]);
});

test('the home page displays chirps', function (): void {
    $response = $this->get('/');
    $response->assertSeeText('hello world');
    $response->assertSeeText('hello');
});

test('the user can only see their own chirps on the dashboard', function (): void {
    $response = $this->actingAs($this->user)->get('/dashboard');
    $response->assertSeeText('hello');
    $response->assertDontSeeText('hello world');
});


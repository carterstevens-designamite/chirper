<?php

use App\Models\User;

test('the user is redirected to the login page if not logged in and tried to create a chirp', function (): void {
    $response = $this->post('/chirp-create', [
        'message' => 'Hello, world!',
    ]);

    $response->assertRedirect('/login');
});

test('the user is redirected to the home page if logged in and tried to create a chirp', function (): void {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post('/chirp-create', [
        'message' => 'Hello, world!',
    ]);

    $response->assertRedirect('/');
});

test('the user cannot create a chirp if there is no text input', function (): void {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post('/chirp-create', [
        'message' => '',
    ]);
    $response->assertSessionHasErrors('message');
    $this->assertDatabaseMissing('chirps', [
        'message' => '',
        'user_id' => $user->id,
    ]);
});

test('the chirp is created successfully if the user is logged in', function (): void {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post('/chirp-create', [
        'message' => 'Hello, world!',
    ]);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('chirps', [
        'message' => 'Hello, world!',
        'user_id' => $user->id,
    ]);
});
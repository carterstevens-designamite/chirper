<?php

use App\Models\Chirp;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->chirp = Chirp::factory()->create([
        'user_id' => $this->user->id,
        'message' => 'hello world',
    ]);
    $this->otherUser = User::factory()->create();
});

test('the user is redirected to the login page if not authenticated', function (): void {
    $response = $this->patch('/chirp/' . $this->chirp->id . '/edit');
    $response->assertRedirect('/login');
});

test('the user is forbidden if the chirp is not theirs', function (): void {
    $response = $this->actingAs($this->otherUser)->patch('/chirp/' . $this->chirp->id . '/edit', [
        'message' => 'hello'
    ]);
    $response->assertForbidden();
    $this->assertDatabaseHas('chirps', [
        'id' => $this->chirp->id,
        'message' => 'hello world',
    ]);
});

test('the user can edit a chirp if they own it', function (): void {
    $response = $this->actingAs($this->user)->patch('/chirp/' . $this->chirp->id . '/edit', [
        'message' => 'hello'
    ]);
    $this->assertDatabaseHas('chirps', [
        'id' => $this->chirp->id,
        'message' => 'hello',
    ]);
});


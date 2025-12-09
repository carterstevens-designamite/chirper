<?php

use App\Models\Chirp;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->chirp = Chirp::factory()->create([
        'user_id' => $this->user->id,
    ]);
    $this->otherUser = User::factory()->create();
});

test('the user is redirected to the login page if not authenticated', function (): void {
    $response = $this->delete('/chirp/' . $this->chirp->id . '/destroy');
    $response->assertRedirect('/login');
});

test('the user cannot delete a chirp that is not theirs', function (): void {

    $response = $this->actingAs($this->otherUser)->delete('/chirp/' . $this->chirp->id . '/destroy');
    $response->assertForbidden();
    $this->assertDatabaseHas('chirps', [
        'id' => $this->chirp->id,
    ]);
});

test('the user can delete a chirp that is theirs', function (): void {

    $response = $this->actingAs($this->user)->delete('/chirp/' . $this->chirp->id . '/destroy');
    $response->assertRedirect('/dashboard');
    $this->assertDatabaseMissing('chirps', [
        'id' => $this->chirp->id,
    ]);
});
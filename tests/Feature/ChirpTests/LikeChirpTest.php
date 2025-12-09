<?php

use App\Models\Chirp;
use App\Models\User;

test('the user can like a chirp', function (): void {
    $user = User::factory()->create();
    $chirp = Chirp::factory()->create();
    $response = $this->actingAs($user)->post('/chirp/' . $chirp->id . '/like');
    $this->assertDatabaseHas('likes', [
        'user_id' => $user->id,
        'chirp_id' => $chirp->id,
    ]);
});

test('the user can unlike a chirp', function (): void {
    $user = User::factory()->create();
    $chirp = Chirp::factory()->create();
    $response = $this->actingAs($user)->delete('/chirp/' . $chirp->id . '/like');
    $this->assertDatabaseMissing('likes', [
        'user_id' => $user->id,
        'chirp_id' => $chirp->id,
    ]);
});

test('the user cannot like a chirp if not authenticated', function () {
    $chirp = Chirp::factory()->create();
    $response = $this->post('/chirp/' . $chirp->id . '/like');
    $this->assertDatabaseMissing('likes', [
        'chirp_id' => $chirp->id,
    ]);
});

test('the like count is incremented when a user likes a chirp', function () {
    $user = User::factory()->create();
    $chirp = Chirp::factory()->create();
    $response = $this->actingAs($user)->post('/chirp/' . $chirp->id . '/like');
    $this->assertDatabaseHas('likes', [
        'user_id' => $user->id,
        'chirp_id' => $chirp->id,
    ]);
    $chirp->refresh();
    $this->assertEquals(1, $chirp->likes_count);
});

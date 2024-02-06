<?php

use App\Models\User;

test('profile information can be updated', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/profile-information', [
        'email' => 'test@example.com',
    ]);

    expect($user->fresh())
        ->email->toEqual('test@example.com');
});

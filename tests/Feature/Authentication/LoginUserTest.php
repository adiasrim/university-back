<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class LoginUserTest extends TestCase
{
    public function test_user_can_login(): void
    {
        $this->createUser([
            'email'    => 'akhmedovmirik@gmail.com',
        ]);

        $this->postJson(route('auth.login'), [
            'email'    => 'akhmedovmirik@gmail.com',
            'password' => 'password'
        ])
            ->assertOk()
            ->assertJsonStructure([
                'data' => ['token', 'user'],
            ]);
    }

    public function test_user_cannot_login_with_invalid_password(): void
    {
        $this->createUser([
            'email'    => 'akhmedovmirik@gmail.com',
        ]);

        $this->postJson(route('auth.login'), [
            'email'    => 'akhmedovmirik@gmail.com',
            'password' => 'invalid-password',
        ])->assertUnauthorized();
    }

    public function test_authenticate_user_cannot_login(): void
    {
        $user = $this->createUser([
            'email'    => 'akhmedovmirik@gmail.com',
        ]);

        $this->authenticate($user);

        $this->postJson(route('auth.login'), [
            'email'    => 'akhmedovmirik@gmail.com',
            'password' => 'password',
        ])->assertForbidden();
    }
}
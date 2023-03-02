<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class CheckUserTest extends TestCase
{
    public function test_check_user(): void
    {
        $user = $this->createUser([
            'email'    => 'akhmedovmirik@gmail.com',
        ]);

        $this->authenticate($user);

        $this->getJson(route('auth.check'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => ['token', 'user'],
            ]);
    }

    public function test_unauthenticated_user_cannot_check(): void
    {
        $this->getJson(route('auth.check'))
            ->assertUnauthorized();
    }
}

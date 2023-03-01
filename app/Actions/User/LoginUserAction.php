<?php

namespace App\Actions\User;

use App\Models\User;
use Hash;

class LoginUserAction
{
    public function execute(array $data): User
    {
        $user = User::where('email', $data['email'])->firstOrFail();

        if (!Hash::check($data['password'], $user->password)) {
            abort(401, 'Invalid credentials');
        }

        return $user;
    }
}
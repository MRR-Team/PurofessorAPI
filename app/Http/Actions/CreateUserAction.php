<?php

namespace App\Http\Actions;

use App\Models\User;

class CreateUserAction
{
    public function __invoke(array $userData): User
    {
        $user = new User($userData);
        $user->save();

        return $user;
    }
}

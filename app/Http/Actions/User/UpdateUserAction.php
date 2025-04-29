<?php

namespace App\Http\Actions\User;

use App\Models\User;

class UpdateUserAction
{
    public function __invoke(User $user, array $userData)
    {
        $user->update($userData);
        return $user;
    }
}

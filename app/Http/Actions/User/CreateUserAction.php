<?php

namespace App\Http\Actions\User;

use App\Models\User;
use App\Notifications\VerifyAccountNotification;

class CreateUserAction
{
    public function __invoke(array $userData): User
    {
        $user = new User($userData);
        $user->save();
        $user->notify(new VerifyAccountNotification());

        activity()
            ->performedOn($user)
            ->withProperties(['email' => $user->email])
            ->log('New user created');
        return $user;
    }
}

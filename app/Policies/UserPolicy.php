<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function updateProfile(User $authenticatedUser, User $user)
    {
        return $authenticatedUser->id === $user->id;
    }
}

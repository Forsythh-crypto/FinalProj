<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
   public function update(User $authUser, User $user)
{
    return $authUser->id === 1; // allow only user with ID 1 (admin)
}

public function delete(User $authUser, User $user)
{
    return $authUser->id === 1; // allow only user with ID 1 (admin)
}

public function viewAny(User $authUser)
{
    return $authUser->id === 1; // allow only admin to view manage users
}

}

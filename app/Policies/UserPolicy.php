<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */    

    public function viewAdminRoles(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function viewAdminDashboard(User $user)
    {
        return $user->isAdmin();
    }

}

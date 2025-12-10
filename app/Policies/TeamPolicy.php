<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Team;
use App\Models\User;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Team $team): bool
    {
        return $user->id === $team->created_by || 
               $team->members->contains($user->id) ||
               $user->hasRole('Admin');
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Team $team): bool
    {
        return $user->id === $team->created_by || $user->hasRole('Admin');
    }

    public function delete(User $user, Team $team): bool
    {
        return $user->id === $team->created_by || $user->hasRole('Admin');
    }

    public function restore(User $user, Team $team): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Team $team): bool
    {
        return $user->hasRole('Admin');
    }
}

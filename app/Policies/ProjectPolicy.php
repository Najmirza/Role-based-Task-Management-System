<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->created_by || 
               $project->team->members->contains($user->id) ||
               $user->hasRole('Admin');
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->created_by || $user->hasRole('Admin');
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->created_by || $user->hasRole('Admin');
    }

    public function restore(User $user, Project $project): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Project $project): bool
    {
        return $user->hasRole('Admin');
    }
}

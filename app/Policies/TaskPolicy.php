<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->created_by || 
               $task->assignees->contains($user->id) ||
               $user->hasRole('Admin');
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->created_by || 
               $task->assignees->contains($user->id) ||
               $user->hasRole('Admin');
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->created_by || $user->hasRole('Admin');
    }

    public function restore(User $user, Task $task): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return $user->hasRole('Admin');
    }
}

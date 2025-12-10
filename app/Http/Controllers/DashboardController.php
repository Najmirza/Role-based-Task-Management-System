<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Stats
        $totalProjects = \App\Models\Project::where('created_by', $user->id)->count();
        $totalTasks = \App\Models\Task::where('created_by', $user->id)
            ->orWhereHas('assignees', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
        $completedTasks = \App\Models\Task::where('status', 'completed')
            ->where(function ($query) use ($user) {
                $query->where('created_by', $user->id)
                    ->orWhereHas('assignees', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
            })->count();
        
        $pendingTasks = $totalTasks - $completedTasks;
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Recent Projects
        $recentProjects = \App\Models\Project::where('created_by', $user->id)
            ->latest()
            ->take(3)
            ->get();

        // Tasks in Progress
        $tasksInProgress = \App\Models\Task::where('status', 'in_progress')
            ->where(function ($query) use ($user) {
                $query->where('created_by', $user->id)
                    ->orWhereHas('assignees', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
            })
            ->take(5)
            ->get();

        // Goals
        $monthlyGoals = \App\Models\Goal::where('user_id', $user->id)
            ->where('month', now()->month)
            ->where('year', now()->year)
            ->get();

        return view('dashboard', compact(
            'totalProjects',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'completionRate',
            'recentProjects',
            'tasksInProgress',
            'monthlyGoals'
        ));
    }
}

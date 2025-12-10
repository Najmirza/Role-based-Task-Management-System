<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\Team;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // 1. Key Counts
        $totalTasks = Task::where('created_by', $userId)->count();
        $totalProjects = Project::where('created_by', $userId)->count();
        $totalTeams = Team::count(); // Assuming teams are global or filtered by membership
        $totalGoals = Goal::where('user_id', $userId)->count();

        // 2. Task Completion Rate
        $completedTasks = Task::where('created_by', $userId)->where('status', 'completed')->count();
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // 3. Tasks by Status
        $tasksByStatus = [
            'todo' => Task::where('created_by', $userId)->where('status', 'todo')->count(),
            'in_progress' => Task::where('created_by', $userId)->where('status', 'in_progress')->count(),
            'completed' => $completedTasks,
        ];

        // 4. Tasks by Priority
        $tasksByPriority = [
            'high' => Task::where('created_by', $userId)->where('priority', 'high')->count(),
            'medium' => Task::where('created_by', $userId)->where('priority', 'medium')->count(),
            'low' => Task::where('created_by', $userId)->where('priority', 'low')->count(),
        ];

        // 5. Recent Completed Tasks
        $recentCompleted = Task::where('created_by', $userId)
            ->where('status', 'completed')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('statistics.index', compact(
            'totalTasks',
            'totalProjects',
            'totalTeams',
            'totalGoals',
            'completionRate',
            'tasksByStatus',
            'tasksByPriority',
            'recentCompleted'
        ));
    }
}

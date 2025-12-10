<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['project', 'assignees'])->where('created_by', auth()->id())
            ->orWhereHas('assignees', function ($query) {
                $query->where('user_id', auth()->id());
            })->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    private function checkAdmin() {
        if (!auth()->user()->role || auth()->user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create(Request $request)
    {
        $this->checkAdmin();
        $projects = Project::where('created_by', auth()->id())->get();
        // Get all users except admins
        $users = User::whereDoesntHave('role', function($q) {
            $q->where('name', 'admin');
        })->get(); 
        $prefilled_date = $request->query('due_date');
        return view('tasks.create', compact('projects', 'users', 'prefilled_date'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'priority' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'due_date' => 'nullable|date',
            'assignees' => 'nullable|array',
            'assignees.*' => 'exists:users,id',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'priority' => $validated['priority'],
            'project_id' => $validated['project_id'],
            'due_date' => $validated['due_date'],
            'created_by' => auth()->id(),
        ]);

        if (isset($validated['assignees'])) {
            $task->assignees()->attach($validated['assignees']);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->checkAdmin();
        $projects = Project::all();
        // Get all users except admins
        $users = User::whereDoesntHave('role', function($q) {
            $q->where('name', 'admin');
        })->get();
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        // Check if Admin OR Assigned User
        $isAssigned = $task->assignees->contains(auth()->id());
        $isAdmin = auth()->user()->role && auth()->user()->role->name === 'admin';

        if (!$isAdmin && !$isAssigned) {
            abort(403, 'Unauthorized.');
        }

        if ($isAdmin) {
            // Admin can update everything
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|string',
                'priority' => 'required|string',
                'project_id' => 'required|exists:projects,id',
                'due_date' => 'nullable|date',
                'assignees' => 'nullable|array',
            ]);

            $task->update($validated);

            if (isset($validated['assignees'])) {
                // Smart Sync: Preserve 'assigned_at' and 'status' for existing assignees
                $currentAssignees = $task->assignees->keyBy('id');
                $syncData = [];
                
                foreach ($validated['assignees'] as $userId) {
                    if ($currentAssignees->has($userId)) {
                        // User exists, keep their data
                        $pivot = $currentAssignees[$userId]->pivot;
                        $syncData[$userId] = [
                            'assigned_at' => $pivot->assigned_at,
                            'status' => $pivot->status
                        ];
                    } else {
                        // New user
                        $syncData[$userId] = [
                            'assigned_at' => now(),
                            'status' => 'pending'
                        ];
                    }
                }
                $task->assignees()->sync($syncData);
            }
        } else {
            // Regular User can ONLY update THEIR OWN status
            $validated = $request->validate([
                'status' => 'required|string|in:pending,in_progress,completed',
            ]);
            
            // Update the pivot record for this specific user, preserving assigned_at
            $currentUserPivot = $task->assignees()->where('user_id', auth()->id())->first()->pivot;
            
            $task->assignees()->updateExistingPivot(auth()->id(), [
                'status' => $validated['status'],
                'assigned_at' => $currentUserPivot->assigned_at
            ]);

            // Check if ALL assignees have completed the task
            $allCompleted = $task->assignees()->get()->every(function ($user) {
                return $user->pivot->status === 'completed';
            });

            if ($allCompleted) {
                $task->update(['status' => 'completed']);
            } elseif ($task->status === 'pending' && $validated['status'] !== 'pending') {
                // Optional: If at least one starts/completes, move main task to in_progress
                $task->update(['status' => 'in_progress']);
            } elseif ($task->status === 'completed' && !$allCompleted) {
                // If it WAS completed but someone moved back to pending, revert main to in_progress
                 $task->update(['status' => 'in_progress']);
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->checkAdmin();
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Team;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role && auth()->user()->role->name === 'admin') {
            $projects = Project::with('team')->latest()->get();
        } else {
            // Users see projects they are part of (via Team or direct assignment if logic existed, but Project usually linked to Team)
            // Assuming User -> Team -> Project relationship exists or Project -> Team -> User
            // For now, let's show projects where user is in the team.
            $projects = Project::whereHas('team.users', function($q) {
                $q->where('user_id', auth()->id());
            })->latest()->get();
        }
        return view('projects.index', compact('projects'));
    }

    private function checkAdmin() {
        if (!auth()->user()->role || auth()->user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create()
    {
        $this->checkAdmin();
        $teams = Team::all(); // Should filter by user's teams
        return view('projects.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'team_id' => 'required|exists:teams,id',
            'due_date' => 'nullable|date',
        ]);

        Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'team_id' => $validated['team_id'],
            'due_date' => $validated['due_date'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->checkAdmin();
        $teams = Team::all();
        return view('projects.edit', compact('project', 'teams'));
    }

    public function update(Request $request, Project $project)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'team_id' => 'required|exists:teams,id',
            'due_date' => 'nullable|date',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->checkAdmin();
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}

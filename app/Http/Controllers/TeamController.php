<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role && auth()->user()->role->name === 'admin') {
            $teams = Team::with('users')->get();
        } else {
            // Show teams the user belongs to
            $teams = Team::whereHas('users', function($q) {
                $q->where('user_id', auth()->id());
            })->get();
        }
        return view('teams.index', compact('teams'));
    }

    private function checkAdmin() {
        if (!auth()->user()->role || auth()->user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create()
    {
        $this->checkAdmin();
        // Get all users except admins
        $users = \App\Models\User::whereDoesntHave('role', function($q) {
            $q->where('name', 'admin');
        })->get();
        return view('teams.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ]);

        $team = Team::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'created_by' => auth()->id(),
        ]);

        if (isset($validated['members'])) {
            $team->users()->attach($validated['members']);
        }

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $this->checkAdmin();
        // Get all users except admins
        $users = \App\Models\User::whereDoesntHave('role', function($q) {
            $q->where('name', 'admin');
        })->get();
        $team->load('users');
        return view('teams.edit', compact('team', 'users'));
    }

    public function update(Request $request, Team $team)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ]);

        $team->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        if (isset($validated['members'])) {
            $team->users()->sync($validated['members']);
        }

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        $this->checkAdmin();
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}

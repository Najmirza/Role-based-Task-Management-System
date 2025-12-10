<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->latest()->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2024',
        ]);

        Goal::create([
            'title' => $validated['title'],
            'month' => $validated['month'],
            'year' => $validated['year'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal set successfully.');
    }

    public function show(Goal $goal)
    {
        //
    }

    public function edit(Goal $goal)
    {
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'is_completed' => 'boolean',
        ]);

        $goal->update($validated);

        return redirect()->back()->with('success', 'Goal updated successfully.');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->back()->with('success', 'Goal deleted successfully.');
    }
}

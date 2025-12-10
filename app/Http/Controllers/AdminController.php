<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Team;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_projects' => Project::count(),
            'total_teams' => Team::count(),
            'total_tasks' => Task::count(),
        ];

        $recent_users = User::with('role')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users'));
    }

    public function users(Request $request)
    {
        $query = User::with('role');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function destroyUser(User $user)
    {
        if ($user->role && $user->role->name === 'admin') {
            return back()->with('error', 'Cannot delete an admin user.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'maintenance_mode' => 'nullable|boolean',
        ]);

        \App\Models\Setting::setValue('site_name', $request->site_name);
        \App\Models\Setting::setValue('maintenance_mode', $request->has('maintenance_mode') ? '1' : '0');

        return back()->with('success', 'Settings updated successfully.');
    }

    public function announcements()
    {
        $announcements = \App\Models\Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,danger,success',
        ]);

        \App\Models\Announcement::create([
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'is_active' => true,
        ]);

        return back()->with('success', 'Announcement posted successfully.');
    }

    public function destroyAnnouncement(\App\Models\Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted successfully.');
    }
}

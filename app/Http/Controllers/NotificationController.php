<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class NotificationController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_active', true)
            ->latest()
            ->paginate(10);

        return view('notifications.index', compact('announcements'));
    }
}

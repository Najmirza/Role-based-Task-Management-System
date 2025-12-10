<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class DefaultAnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::firstOrCreate(
            ['title' => 'Welcome to the New Admin System!'],
            [
                'message' => 'We have updated the system with a new Admin Panel. Check out the Settings and Announcements features.',
                'type' => 'info',
                'is_active' => true,
            ]
        );
    }
}

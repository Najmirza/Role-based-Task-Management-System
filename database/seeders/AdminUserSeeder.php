<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        // Ensure role exists if not found (fallback)
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin', 'description' => 'Administrator']);
        }

        // ── Admin Account ──────────────────────────────────────────
        //  Email   : admin@taskmanager.com
        //  Password: Admin@1234
        // ──────────────────────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@taskmanager.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('Admin@1234'),
                'role_id'  => $adminRole->id,
            ]
        );

        // If admin already existed with old email, force-update password & role
        if (!$admin->wasRecentlyCreated) {
            $admin->update([
                'password' => Hash::make('Admin@1234'),
                'role_id'  => $adminRole->id,
            ]);
        }

        // ── Keep legacy admin email working too (update its password) ──
        $legacy = User::where('email', 'admin@role.com')->first();
        if ($legacy) {
            $legacy->update([
                'password' => Hash::make('Admin@1234'),
                'role_id'  => $adminRole->id,
            ]);
        }
    }
}

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

        User::firstOrCreate(
            ['email' => 'admin@role.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
            ]
        );
    }
}

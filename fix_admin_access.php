<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting Fix...\n";

// 1. Fix Role Names (Force Lowercase)
$roles = Role::all();
foreach ($roles as $role) {
    $lowerName = strtolower($role->name);
    if ($role->name !== $lowerName) {
        // Check if lowercase exists to avoid unique constraint
        $existing = Role::where('name', $lowerName)->first();
        if ($existing) {
            echo "Merging role '{$role->name}' into existing '{$lowerName}'...\n";
            // Reassign users
            User::where('role_id', $role->id)->update(['role_id' => $existing->id]);
            $role->delete();
        } else {
            echo "Renaming role '{$role->name}' to '{$lowerName}'...\n";
            $role->name = $lowerName;
            $role->save();
        }
    }
}

// 2. Ensure Admin Role Exists
$adminRole = Role::where('name', 'admin')->first();
if (!$adminRole) {
    echo "Creating 'admin' role...\n";
    $adminRole = Role::create(['name' => 'admin', 'description' => 'Administrator']);
}

// 3. Ensure Admin User Exists & Has Role
$adminUser = User::where('email', 'admin@role.com')->first();
if (!$adminUser) {
    echo "Creating admin user...\n";
    $adminUser = User::create([
        'name' => 'System Admin',
        'email' => 'admin@role.com',
        'password' => Hash::make('password'),
        'role_id' => $adminRole->id,
    ]);
} else {
    echo "Updating admin user role...\n";
    $adminUser->role_id = $adminRole->id;
    $adminUser->save();
}

echo "FIX COMPLETED.\n";
echo "Admin User: {$adminUser->name}, Role: {$adminUser->role->name}\n";

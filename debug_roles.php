<?php

use App\Models\User;
use App\Models\Role;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- ROLES IN DB ---\n";
foreach (Role::all() as $role) {
    echo "ID: {$role->id}, Name: '{$role->name}'\n";
}

echo "\n--- ADMIN USER CHECK ---\n";
$admin = User::where('email', 'admin@role.com')->with('role')->first();

if ($admin) {
    echo "User Found: {$admin->name}\n";
    echo "Role ID: " . ($admin->role_id ?? 'NULL') . "\n";
    if ($admin->role) {
        echo "Role Name via Relation: '{$admin->role->name}'\n";
        echo "Is Admin Check: " . ($admin->role->name === 'admin' ? 'YES' : 'NO') . "\n";
    } else {
        echo "Role Relation: NULL\n";
    }
} else {
    echo "User 'admin@role.com' NOT FOUND.\n";
}

echo "\n--- TEST USER CHECK ---\n";
$test = User::where('email', 'test@example.com')->with('role')->first();
if ($test) {
    echo "User Found: {$test->name}\n";
    echo "Role ID: " . ($test->role_id ?? 'NULL') . "\n";
}

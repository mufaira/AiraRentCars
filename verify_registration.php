<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$user = User::find(8);
$admin = User::find(9);

if ($user) {
    $user_is_admin = $user->is_admin ? 'true' : 'false';
    $user_is_staff = $user->is_staff ? 'true' : 'false';
    echo "User (ID: 8): is_admin = $user_is_admin, is_staff = $user_is_staff\n";
}

if ($admin) {
    $admin_is_admin = $admin->is_admin ? 'true' : 'false';
    $admin_is_staff = $admin->is_staff ? 'true' : 'false';
    echo "Admin (ID: 9): is_admin = $admin_is_admin, is_staff = $admin_is_staff\n";
}

// Verify database structure
echo "\nAll users in database:\n";
$all_users = User::all(['id', 'name', 'email', 'is_admin', 'is_staff']);
foreach ($all_users as $u) {
    $is_admin = $u->is_admin ? 'true' : 'false';
    $is_staff = $u->is_staff ? 'true' : 'false';
    echo "  - ID: {$u->id}, Name: {$u->name}, Email: {$u->email}, Admin: $is_admin, Staff: $is_staff\n";
}

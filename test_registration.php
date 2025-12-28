<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

// Test creating regular user
try {
    User::where('email', 'testuser@example.com')->delete();
    $user = User::create([
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => bcrypt('password123'),
        'is_admin' => false,
        'is_staff' => false,
    ]);
    echo "✓ User created successfully!\n";
    echo "  ID: {$user->id}, Email: {$user->email}, is_admin: {$user->is_admin}, is_staff: {$user->is_staff}\n";
} catch (\Exception $e) {
    echo "✗ Error creating user: {$e->getMessage()}\n";
}

// Test creating admin user
try {
    User::where('email', 'testadmin@example.com')->delete();
    $admin = User::create([
        'name' => 'Test Admin',
        'email' => 'testadmin@example.com',
        'password' => bcrypt('password123'),
        'is_admin' => true,
        'is_staff' => true,
        'email_verified_at' => now(),
    ]);
    echo "✓ Admin created successfully!\n";
    echo "  ID: {$admin->id}, Email: {$admin->email}, is_admin: {$admin->is_admin}, is_staff: {$admin->is_staff}\n";
} catch (\Exception $e) {
    echo "✗ Error creating admin: {$e->getMessage()}\n";
}

echo "\n✓ Registration functionality test complete!\n";

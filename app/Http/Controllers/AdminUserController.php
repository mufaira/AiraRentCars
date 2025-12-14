<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing user access.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user staff/admin status.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_staff' => 'required|boolean',
            'is_admin' => 'required|boolean',
        ]);

        $user->update([
            'is_staff' => (bool) $validated['is_staff'],
            'is_admin' => (bool) $validated['is_admin'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akses user berhasil diubah!');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}

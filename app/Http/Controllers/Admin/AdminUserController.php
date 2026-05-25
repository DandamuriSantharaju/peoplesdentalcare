<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // List all admins
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('admin.users', compact('admins'));
    }

    // Store new admin
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,superadmin',
        ]);

        Admin::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => true,
        ]);

        return back()->with('success', 'Admin user created successfully!');
    }

    // Toggle active/inactive
    public function toggleStatus(Admin $admin)
    {
        // Prevent deactivating yourself
        if ($admin->id === Auth::guard('admin')->id()) {
            return back()->withErrors(['error' => 'You cannot deactivate yourself.']);
        }

        $admin->update(['is_active' => !$admin->is_active]);
        return back()->with('success', 'Status updated successfully!');
    }

    // Delete admin
    public function destroy(Admin $admin)
    {
        if ($admin->id === Auth::guard('admin')->id()) {
            return back()->withErrors(['error' => 'You cannot delete yourself.']);
        }

        $admin->delete();
        return back()->with('success', 'Admin user deleted!');
    }

    // Show change password form
    public function showChangePassword()
    {
        return view('admin.change-password');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    // Update admin profile
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'role'  => 'required|in:admin,superadmin',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $admin->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

          // Only update password if filled in
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $admin->update($data);

        return back()->with('success', 'Admin updated successfully!');
    }
}
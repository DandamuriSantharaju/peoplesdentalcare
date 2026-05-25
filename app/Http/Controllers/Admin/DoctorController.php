<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->get();
        $total    = $doctors->count();
        $active   = $doctors->where('status', 'active')->count();
        $inactive = $doctors->where('status', 'inactive')->count();
        return view('admin.doctors', compact('doctors', 'total', 'active', 'inactive'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:100',
            'specialization'   => 'nullable|string|max:100',
            'phone'            => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:100',
            'address'          => 'nullable|string|max:255',
            'qualification'    => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0|max:60',
            'bio'              => 'nullable|string',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'           => 'required|in:active,inactive',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        Doctor::create($data);
        return back()->with('success', 'Doctor added successfully!');
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name'             => 'required|string|max:100',
            'specialization'   => 'nullable|string|max:100',
            'phone'            => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:100',
            'address'          => 'nullable|string|max:255',
            'qualification'    => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0|max:60',
            'bio'              => 'nullable|string',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'           => 'required|in:active,inactive',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update($data);
        return back()->with('success', 'Doctor updated successfully!');
    }

    public function toggleStatus(Doctor $doctor)
    {
        $doctor->update([
            'status' => $doctor->status === 'active' ? 'inactive' : 'active'
        ]);
        return back()->with('success', 'Doctor status updated!');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        $doctor->delete();
        return back()->with('success', 'Doctor deleted!');
    }
}
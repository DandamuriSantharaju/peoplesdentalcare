<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // ── LIST ──────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Patient::withCount('appointments')->latest();

        // Search
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name',  'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%");
            });
        }

        // Gender filter
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $perPage = in_array($request->per_page, [10, 20, 50, 100])
            ? $request->per_page : 10;

        $patients = $query->paginate($perPage)->withQueryString();

        $total    = Patient::count();
        $active   = Patient::where('status', 'active')->count();
        $inactive = Patient::where('status', 'inactive')->count();
        $newThisMonth = Patient::whereMonth('created_at', now()->month)
                               ->whereYear('created_at',  now()->year)
                               ->count();

        return view('admin.patients', compact(
            'patients', 'total', 'active', 'inactive', 'newThisMonth', 'perPage'
        ));
    }

    // ── STORE ─────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:100',
            'phone'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:150',
            'address'        => 'nullable|string|max:255',
            'gender'         => 'nullable|in:male,female,other',
            'date_of_birth'  => 'nullable|date|before:today',
            'blood_group'    => 'nullable|string|max:10',
            'medical_notes'  => 'nullable|string',
            'status'         => 'required|in:active,inactive',
        ]);

        Patient::create($request->only([
            'name', 'phone', 'email', 'address',
            'gender', 'date_of_birth', 'blood_group',
            'medical_notes', 'status',
        ]));

        return redirect()->route('admin.patients')
            ->with('success', 'Patient added successfully!');
    }

    // ── SHOW (detail + appointment history) ───────────────
    public function show(Patient $patient)
    {
        $patient->load(['appointments' => function ($q) {
            $q->latest('date');
        }]);
        return view('admin.patient-view', compact('patient'));
    }

    // ── UPDATE ────────────────────────────────────────────
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name'           => 'required|string|max:100',
            'phone'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:150',
            'address'        => 'nullable|string|max:255',
            'gender'         => 'nullable|in:male,female,other',
            'date_of_birth'  => 'nullable|date|before:today',
            'blood_group'    => 'nullable|string|max:10',
            'medical_notes'  => 'nullable|string',
            'status'         => 'required|in:active,inactive',
        ]);

        $patient->update($request->only([
            'name', 'phone', 'email', 'address',
            'gender', 'date_of_birth', 'blood_group',
            'medical_notes', 'status',
        ]));

        return redirect()->route('admin.patients')
            ->with('success', 'Patient updated successfully!');
    }

    // ── DELETE ────────────────────────────────────────────
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with('success', 'Patient deleted!');
    }

    // ── TOGGLE STATUS ─────────────────────────────────────
    public function toggleStatus(Patient $patient)
    {
        $patient->update([
            'status' => $patient->status === 'active' ? 'inactive' : 'active',
        ]);
        return back()->with('success', 'Patient status updated!');
    }
}
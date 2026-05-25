<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%");
            });
        }

        $perPage = in_array($request->per_page, [10, 20, 50, 100]) ? $request->per_page : 10;
        $appointments = $query->paginate($perPage)->withQueryString();

        $total     = Appointment::count();
        $pending   = Appointment::where('status', 'pending')->count();
        $confirmed = Appointment::where('status', 'confirmed')->count();
        $cancelled = Appointment::where('status', 'cancelled')->count();

        return view('admin.appointments', compact(
            'appointments', 'total', 'pending', 'confirmed', 'cancelled', 'perPage'
        ));
    }

    public function create()
    {
        return view('admin.appointment-form', ['appointment' => null]);
    }

    // ─────────────────────────────────────────────────────────────────
    // STORE — saves appointment AND auto-creates/finds patient by phone
    // ─────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:100',
            'date'    => 'nullable|date',
            'time'    => 'nullable|string',
            'notes'   => 'nullable|string',
            'status'  => 'required|in:pending,confirmed,cancelled',
        ]);

        // ── AUTO PATIENT: find by phone, or create new ──────────────
        $patient = Patient::firstOrCreate(
            ['phone' => $request->phone],           // search by phone number
            [                                        // if not found, create with:
                'name'    => $request->name,
                'email'   => $request->email,
                'address' => $request->address,
                'status'  => 'active',
            ]
        );

        // If patient already existed, keep name/email up to date
        if (!$patient->wasRecentlyCreated) {
            $patient->update([
                'name'  => $request->name,
                'email' => $request->email ?? $patient->email,
            ]);
        }
        // ───────────────────────────────────────────────────────────

        Appointment::create([
            'patient_id' => $patient->id,
            'name'       => $request->name,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'address'    => $request->address,
            'service'    => $request->service,
            'date'       => $request->date,
            'time'       => $request->time,
            'notes'      => $request->notes,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment created & patient record saved!');
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointment-view', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.appointment-form', compact('appointment'));
    }

    // ─────────────────────────────────────────────────────────────────
    // UPDATE — also keeps patient record in sync
    // ─────────────────────────────────────────────────────────────────
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:100',
            'date'    => 'nullable|date',
            'time'    => 'nullable|string',
            'notes'   => 'nullable|string',
            'status'  => 'required|in:pending,confirmed,cancelled',
        ]);

        // ── SYNC PATIENT ────────────────────────────────────────────
        $patient = Patient::firstOrCreate(
            ['phone' => $request->phone],
            [
                'name'    => $request->name,
                'email'   => $request->email,
                'address' => $request->address,
                'status'  => 'active',
            ]
        );

        $patient->update([
            'name'  => $request->name,
            'email' => $request->email ?? $patient->email,
        ]);
        // ───────────────────────────────────────────────────────────

        $appointment->update([
            'patient_id' => $patient->id,
            'name'       => $request->name,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'address'    => $request->address,
            'service'    => $request->service,
            'date'       => $request->date,
            'time'       => $request->time,
            'notes'      => $request->notes,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment updated successfully!');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', 'Appointment deleted!');
    }

    public function updateStatus(Appointment $appointment, $status)
    {
        $appointment->update(['status' => $status]);
        return back()->with('success', 'Status updated!');
    }
}
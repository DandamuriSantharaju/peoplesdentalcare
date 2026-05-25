<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Appointment stats ──────────────────────────────
        $total     = Appointment::count();
        $pending   = Appointment::where('status', 'pending')->count();
        $confirmed = Appointment::where('status', 'confirmed')->count();
        $cancelled = Appointment::where('status', 'cancelled')->count();

        // ── Today's appointments ───────────────────────────
        $todayAppointments = Appointment::whereDate('date', today())->count();

        // ── Patient stats ──────────────────────────────────
        $totalPatients = Patient::count();
        $newPatientsThisMonth = Patient::whereMonth('created_at', now()->month)
                                       ->whereYear('created_at',  now()->year)
                                       ->count();

        // ── Recent appointments (last 20) ──────────────────
        // $appointments = Appointment::latest()->take(20)->get();
        // ── Today's appointments for table ────────────────
        $appointments = Appointment::whereDate('date', today())
                                    ->latest()
                                    ->get();

        return view('admin.dashboard', compact(
            'total', 'pending', 'confirmed', 'cancelled',
            'todayAppointments',
            'totalPatients', 'newPatientsThisMonth',
            'appointments'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class PageController extends Controller
{
    public function home()
    {
        return view('home', ['currentPage' => 'home']);
    }

    public function services()
    {
        return view('services', ['currentPage' => 'services']);
    }

    public function serviceDetail($slug)
    {
        return view('service-detail', ['currentPage' => 'services', 'slug' => $slug]);
    }

    public function contact()
    {
        return view('contact', ['currentPage' => 'contact']);
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'phone' => 'required|string|max:20',
        ]);

        Appointment::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'service' => $request->service,
            'date'    => $request->date,
            'time'    => $request->time,
            'notes'   => $request->notes,
            'status'  => 'pending',
        ]);

        // Return JSON for AJAX modal
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment booked successfully!'
            ]);
        }

        return back()->with('success', 'Appointment booked successfully!');
    }
}
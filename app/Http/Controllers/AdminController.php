<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Uzimamo sve termine, sortirane tako da najnoviji zahtevi budu prvi. 
        // Koristimo eager loading (with) da smanjimo broj upita bazi.
        $appointments = Appointment::with(['user', 'service'])->latest()->get();
        
        return view('admin.appointments.index', compact('appointments'));
    }

    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'approved']);

        return back()->with('success', 'Termin wurde erfolgreich bestätigt.');
    }

    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'rejected']);

        return back()->with('error', 'Der Termin wurde abgelehnt.');
    }
}
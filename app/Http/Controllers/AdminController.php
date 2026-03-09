<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Prikaz svih termina u admin panelu
     */
    public function index()
    {
        // Uzimamo sve termine, sortirane tako da najnoviji zahtevi budu prvi
        $appointments = Appointment::with(['user', 'service'])->latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Odobravanje termina
     */
    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'approved']);

        return back()->with('success', 'Termin je uspešno odobren.');
    }

    /**
     * Odbijanje termina
     */
    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'rejected']);

        return back()->with('error', 'Termin je odbijen.');
    }
}
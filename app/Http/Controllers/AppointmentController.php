<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;

class AppointmentController extends Controller
{
    
    public function index()
    {
        // Umesto da tražiš index.blade, samo pozovi create() metodu
        return $this->create();
    }

    
  public function create() 
    {
        $services = Service::all();
        $availableAppointments = Appointment::whereNull('user_id')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('appointments.create', compact('services', 'availableAppointments'));
    }

    public function store(Request $request)
    {
        // 1. Klijent šalje ID slota koji je izabrao
        $appointment = Appointment::findOrFail($request->appointment_id);

        // 2. Proveravamo da li je slot još uvek slobodan
        if ($appointment->user_id !== null) {
            return back()->with('error', 'Dieser Termin wurde gerade eben von jemand anderem gebucht.');
        }

        // 3. Upisujemo klijenta u taj slot
        $appointment->update([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id, // Klijent bira koju uslugu želi u tom terminu
            'status' => 'pending' // Čeka tvoje odobrenje na dashboardu
        ]);

        return redirect()->route('welcome')->with('success', 'Vielen Dank! Wir prüfen Ihren Terminwunsch.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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
        $user = auth()->user(); // Podaci o ulogovanom korisniku

        // Uzimamo termine koji pripadaju ovom korisniku
        $appointments = Appointment::with('service')
            ->where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        // Prosleđujemo obe varijable koje Blade traži
        return view('profile.index', [
            'user' => $user,
            'appointments' => $appointments,
            'myAppointments' => $appointments // Dodajemo i ovo jer ga koristiš na dnu blade-a
        ]);
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

    public function store(StoreAppointmentRequest $request)
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

        return redirect()->back()->with('success', 'Vielen Dank! Wir prüfen Ihren Terminwunsch.');
    }
    public function cancel(Appointment $appointment)
    {
        // Provera da li klijent pokušava da otkaže svoj termin, a ne tuđi
        if (auth()->id() !== $appointment->user_id) {
            abort(403);
        }

        // Menjamo status u cancelled umesto da brišemo, 
        // kako bi admin video u istoriji da je klijent otkazao
        $appointment->update(['status' => 'cancelled']);

        // Vraćamo ga nazad sa porukom u aplikaciji
        return back()->with('success', 'Dein Termin wurde erfolgreich storniert.');
    }

    
}

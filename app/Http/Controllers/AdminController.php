<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Product;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentApproved;
use App\Mail\AppointmentCancelled;

class AdminController extends Controller
{
    /**
     * GLAVNI DASHBOARD (Index)
     * Prikazuje statistiku i listu svih termina/slotova
     */
    public function index()
    {
        // Uzimamo sve termine (i rezervisane i prazne slotove)
        $appointments = Appointment::with(['user', 'service'])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
            
        // Statistika za Dashboard kartice
        $stats = [
            'pending'  => Appointment::where('status', 'pending')->count(),
            'today'    => Appointment::where('date', now()->toDateString())->count(),
            'messages' => Message::where('is_read', false)->count(),
            'products' => Product::count(),
        ];

        // Razdvajamo ih (opciono, ako želiš da ih u blade-u koristiš odvojeno)
        $booked = $appointments->whereNotNull('user_id');
        $availableSlots = $appointments->whereNull('user_id');

        return view('admin.appointments.index', compact('appointments', 'stats', 'booked', 'availableSlots'));
    }

    /**
     * UPRAVLJANJE TERMINIMA (Slotovi i Rezervacije)
     */

    // 1. Stvaranje PRAZNOG slota koji klijenti vide
    public function storeSlot(Request $request) 
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'service_id' => 'required|exists:services,id'
        ]);

        Appointment::create([
            'user_id' => null, 
            'service_id' => $request->service_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'approved' 
        ]);

        return back()->with('success', 'Freier Slot wurde erfolgreich erstellt!');
    }

    // 2. Potvrda termina kada se klijent prijavi
    public function approve(Appointment $appointment)
    {
        $appointment->update(['status' => 'approved']);

        Mail::to($appointment->user->email)->send(new AppointmentApproved($appointment));
        return back()->with('success', 'Termin wurde erfolgreich bestätigt.');
    }

    // 3. Odbijanje/Otkazivanje termina
    public function reject(Appointment $appointment)
    {
        $appointment->update(['status' => 'rejected']);
        return back()->with('error', 'Der Termin wurde abgelehnt.');
    }

    // 4. Brisanje termina ili slota zauvek
    public function destroy(Appointment $appointment) 
    {
        // Ako termin pripada korisniku (nije samo prazan slot), pošalji mejl
        if ($appointment->user) {
            Mail::to($appointment->user->email)->send(new AppointmentCancelled($appointment));
        }

        $appointment->delete();

        return back()->with('success', 'Termin gelöscht und Kunde benachrichtigt.');
    }
    public function createSlot()
    {
        $services = Service::all();
        return view('admin.appointments.create', compact('services'));
    }

    /**
     * UPRAVLJANJE KLIJENTIMA (CRM)
     */

    public function usersIndex() 
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function usersShow(User $user) 
    {
        $user->load('appointments.service');
        return view('admin.users.show', compact('user'));
    }

    public function userDestroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Sie können sich nicht selbst löschen!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Benutzer wurde gelöscht.');
    }

    public function updateNotes(Request $request, User $user)
    {
        $user->update(['notes' => $request->notes]);
        return back()->with('success', 'Notizen wurden aktualisiert!');
    }
}
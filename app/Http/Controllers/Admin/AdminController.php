<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Product;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentApproved;
use App\Mail\AppointmentCancelled;
use App\Models\Order;
use App\Http\Requests\Admin\StoreSlotRequest;

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
            ->take(10)
            ->get();
            
        // Statistika za Dashboard kartice
       $stats = [
            'pending_orders' => Order::where('status', 'pending')->count(), // Nove porudžbine
            'products'       => Product::count(),
            'pending'        => Appointment::where('status', 'pending')->count(), // Zahtevi za termine
            'today'          => Appointment::whereDate('date', now())->count(),
            'messages'       => Message::where('is_read', false)->count(),
            // 1. Ukupna zarada od završenih porudžbina
            'total_revenue'  => Order::where('status', 'completed')->sum('total_price'),
            
            // 2. Broj zakazanih termina u ovom mesecu
            'month_apps'     => Appointment::whereMonth('date', now()->month)
                                            ->whereYear('date', now()->year)
                                            ->count(),
                                            
            // 3. Broj registrovanih klijenata
            'total_users'    => User::where('role', 'user')->count(),
        ];

        // Razdvajamo ih (opciono, ako želiš da ih u blade-u koristiš odvojeno)
        $booked = Appointment::whereNotNull('user_id')->with(['user', 'service'])->get();
        $availableSlots = Appointment::whereNull('user_id')->get();
        $latest_orders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.appointments.index', compact('appointments', 'stats', 'booked', 'availableSlots', 'latest_orders'));
    }

    /**
     * UPRAVLJANJE TERMINIMA (Slotovi i Rezervacije)
     */

    // 1. Stvaranje PRAZNOG slota koji klijenti vide
   public function storeSlot(StoreSlotRequest $request)
    {
        // Ako kod dođe do ovde, znači da su datum i vreme već validni i unikatni
        Appointment::create($request->validated() + [
            'user_id' => null,
            'status' => null
        ]);

        return back()->with('success', 'Termin erstellt.');
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
        
        $data = $request->validate([
            'notes' => 'nullable|string|max:1000'
        ]);

        $user->update($data);
        return back()->with('success', 'Notizen wurden aktualisiert!');
    }
}
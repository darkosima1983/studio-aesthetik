<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Product;
use App\Models\Message;

class AdminController extends Controller
{
    

    public function index()
    {
        
        $appointments = Appointment::with(['user', 'service'])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
            
       
        $stats = [
            'pending'  => Appointment::where('status', 'pending')->count(),
            'today'    => Appointment::where('date', now()->toDateString())->count(),
            'messages' => Message::where('is_read', false)->count(),
            'products' => Product::count(),
        ];

       
        return view('admin.appointments.index', compact('appointments', 'stats'));
    }
    
    public function approve(Appointment $appointment)
    {
        $appointment->update(['status' => 'approved']);

        return back()->with('success', 'Termin wurde erfolgreich bestätigt.');
    }

    /**
     * Odbijanje termina.
     */
    public function reject(Appointment $appointment)
    {
        $appointment->update(['status' => 'rejected']);

        return back()->with('error', 'Der Termin wurde abgelehnt.');
    }

    public function usersIndex() 
    {
        // Uzimamo sve korisnike koji nisu admini
        $users = \App\Models\User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function usersShow(\App\Models\User $user) 
    {
        // Učitavamo korisnika i njegove termine sa povezanim servisima
        $user->load('appointments.service');
        return view('admin.users.show', compact('user'));
    }

    public function userDestroy(\App\Models\User $user)
    {
        // Provera da ne obrišeš samog sebe (ako si ulogovan kao taj admin)
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Sie können sich nebst selbst löschen!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Benutzer wurde gelöscht.');
    }

    public function updateNotes(Request $request, \App\Models\User $user)
    {
        $user->update(['notes' => $request->notes]);

        return back()->with('success', 'Notizen wurden aktualisiert!');
    }
}
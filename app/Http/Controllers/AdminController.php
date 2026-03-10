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
        // 1. Uzimamo sve termine sa podacima o korisniku i usluzi
        $appointments = Appointment::with(['user', 'service'])->latest()->get();
        
        // 2. Kreiramo stats niz koji tvoj Blade traži na liniji 21
        $stats = [
            'pending'  => Appointment::where('status', 'pending')->count(),
            'today'    => Appointment::where('date', now()->toDateString())->count(),
            'messages' => Message::where('is_read', false)->count(),
            'products' => Product::count(),
        ];

        // 3. Šaljemo OBE varijable u view
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
}
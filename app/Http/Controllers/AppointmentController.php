<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Umesto da tražiš index.blade, samo pozovi create() metodu
        return $this->create();
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $services = Service::all();
        
        // Generisanje slobodnih slotova
        $slots = [];
        $start = 10;
        $end = 18;
        
        for ($i = $start; $i < $end; $i++) {
            $slots[] = sprintf('%02d:00', $i);
        }

        return view('appointments.create', compact('services', 'slots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date'       => 'required|date|after_or_equal:today',
            'time'       => 'required',
        ]);

        // Dodajemo user_id trenutno ulogovanog korisnika
        $validated['user_id'] = auth()->id();
        // Početni status je uvek na čekanju (pending)
        $validated['status']  = 'pending';

        \App\Models\Appointment::create($validated);

        return redirect()->route('appointments.index')
                        ->with('success', 'Vielen Dank! Ihre Terminanfrage wurde erfolgreich entgegengenommen und wird in Kürze von uns bestätigt.');
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

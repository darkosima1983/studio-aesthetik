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
        
        // Generisanje slobodnih slotova
        $slots = [];
        $start = 10;
        $end = 18;
        
        for ($i = $start; $i < $end; $i++) {
            $slots[] = sprintf('%02d:00', $i);
        }

        return view('appointments.create', compact('services', 'slots'));
    }

    
    public function store(StoreAppointmentRequest $request) 
    {
      

        $validated = $request->validated(); // Uzima samo proverene podatke

        $validated['user_id'] = auth()->id();
        $validated['status']  = 'pending';

        Appointment::create($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Vielen Dank! Ihre Terminanfrage wurde gesendet.');
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

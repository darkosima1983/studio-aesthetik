<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Lista za klijente (javno)
    public function index(Request $request)
    {
        $services = Service::all();

        // Ako URL sadrži reč 'admin', pošalji ga na admin tabelu
        if ($request->is('admin/*')) {
            return view('admin.services.index', compact('services'));
        }

        // U suprotnom, pošalji ga na javni cenovnik za klijente
        return view('services.index', compact('services'));
    }

    // Forma za novu uslugu (Admin)
    public function create()
    {
        return view('admin.services.create');
    }

    // Čuvanje u bazu
    public function store(StoreServiceRequest $request)
    {
        Service::create($request->validated());
        return redirect()->route('admin.services.index')->with('success', 'Dienstleistung erstellt!');
    }

    // Otvara formu za izmenu
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Čuva izmene
    public function update(StoreServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('admin.services.index')
            ->with('success', 'Dienstleistung wurde aktualisiert!');
    }

    // Brisanje (Admin)
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Dienstleistung gelöscht.');
    }
}
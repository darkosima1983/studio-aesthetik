<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Prikaz svih poruka (Admin deo)
     */
    public function index()
    {
        $messages = Message::latest()->get(); // Najnovije poruke prve
        return view('messages.index', compact('messages'));
    }

    /**
     * Store: Ovo je metoda koja čuva poruku kada klijent klikne "Pošalji"
     */
    public function store(Request $request)
    {
        // 1. Validacija podataka
        $validated = $request->validate([
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string|min:5',
        ]);

        // 2. Čuvanje u bazu
        Message::create($validated);

        // 3. Povratna informacija klijentu na nemačkom
        return back()->with('success', 'Vielen Dank für Ihre Nachricht! Wir werden uns so schnell wie möglich bei Ihnen melden.');
    }

    /**
     * Prikaz jedne konkretne poruke
     */
    public function show(Message $message)
    {
        // Označimo poruku kao pročitanu kada je otvorimo
        $message->update(['is_read' => true]);
        
        return view('messages.show', compact('message'));
    }

    /**
     * Brisanje poruke
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Nachricht gelöscht.');
    }
}
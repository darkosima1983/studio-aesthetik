<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;

class MessageController extends Controller
{
    /**
     * Prikaz svih poruka (Admin deo)
     */
    public function index()
    {
        $messages = Message::latest()->get(); // Najnovije poruke prve
        return view('admin.messages.index', compact('messages'));
    }

    public function store(StoreMessageRequest $request)
    {
        // Laravel automatski validira podatke pre nego što uđe ovde
        Message::create($request->validated());

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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Uzimamo termine korisnika poređane po datumu (najnoviji prvo)
        $appointments = $user->appointments()
            ->with('service')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('profile.index', compact('user', 'appointments'));
    }
}

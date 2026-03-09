<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // Dodaj ovo na vrh

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Dinamičko preusmeravanje nakon logovanja.
     */
    protected function redirectTo()
    {
        if (Auth::user()->role === 'admin') {
            return route('admin.dashboard');
        }

        // Klijente šaljemo na listu njihovih termina
        return route('appointments.index');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
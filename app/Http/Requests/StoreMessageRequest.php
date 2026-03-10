<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Svako može da pošalje poruku preko kontakt forme
        return true; 
    }

    public function rules(): array
    {
        return [
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string|min:10|max:2000', 
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'   => 'Bitte geben Sie Ihre E-Mail-Adresse ein.',
            'email.email'      => 'Die E-Mail-Adresse muss gültig sein.',
            'content.required' => 'Bitte schreiben Sie uns eine Nachricht.',
            'content.min'      => 'Ihre Nachricht ist zu kurz (mindestens 10 Zeichen).',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Dozvoljavamo samo ulogovanim korisnicima
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // Validira da je ID servisa poslat i da postoji u tabeli services
            'service_id'     => 'required|exists:services,id',
            
            // Validira da je ID termina poslat i da postoji u tabeli appointments
            'appointment_id' => 'required|exists:appointments,id',
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required'     => 'Bitte wählen Sie eine Dienstleistung aus.',
            'appointment_id.required' => 'Bitte wählen Sie einen Termin aus.',
        ];
    }
}

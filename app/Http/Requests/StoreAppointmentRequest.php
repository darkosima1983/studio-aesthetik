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
            'service_id' => 'required|exists:services,id',
            'date'       => 'required|date|after_or_equal:today',
            'time'       => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'date.after_or_equal' => 'Das Datum darf neicht in der Vergangenheit liegen.',
            'service_id.required' => 'Bitte wählen Sie eine Dienstleistung aus.',
        ];
    }
}

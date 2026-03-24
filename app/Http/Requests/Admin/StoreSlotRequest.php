<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Appointment;

class StoreSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            // Datum mora biti danas ili u budućnosti
            'date' => 'required|date|after_or_equal:today',
            // Provera jedinstvenosti: datum i vreme moraju biti unikatni u tabeli appointments
            'time' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = Appointment::where('date', $this->date)
                        ->where('time', $value)
                        ->exists();
                    if ($exists) {
                        $fail('Dieser Termin existiert bereits!');
                    }
                },
            ],
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
   public function authorize(): bool
{
    return auth()->user()->role === 'admin';
}

public function rules(): array
{
    return [
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:500',
        'price' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:5', // Trajanje u minutima
    ];
}
}

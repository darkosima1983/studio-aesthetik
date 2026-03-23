<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
        {
            return auth()->user()->role === 'admin';
        }

        public function rules(): array
        {
            return [
                'name'        => 'required|string|max:255',
                'description' => 'required|string|min:10', // Smanjio sam malo min karaktere radi lakšeg testiranja
                'price'       => 'required|numeric|min:0',
                'stock'       => 'required|integer|min:0',
                'category'    => 'nullable|string|max:100',
                // Slika je obavezna pri kreiranju, ali opciona pri editu (ako se ne menja)
                'image'       => $this->isMethod('POST') 
                                ? 'required|image|mimes:jpeg,png,jpg,webp|max:2048' 
                                : 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ];
        }

        public function messages(): array
        {
            return [
                'name.required'  => 'Bitte geben Sie den Produktnamen ein.',
                'price.numeric'  => 'Der Preis muss eine Zahl sein.',
                'image.max'      => 'Das Bild darf nicht größer als 2MB sein.',
            ];
}
}

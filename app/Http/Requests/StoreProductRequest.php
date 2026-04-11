<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id', 
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'qty.required' => 'Kuantitas wajib diisi.',
            'qty.integer' => 'Kuantitas harus berupa angka.',
            'price.required' => 'Harga produk wajib diisi.',
        ];
    }
}
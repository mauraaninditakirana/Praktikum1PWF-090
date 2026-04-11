<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'qty' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ];
    }
}
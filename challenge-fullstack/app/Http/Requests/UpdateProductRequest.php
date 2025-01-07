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
            'name'        => 'sometimes|string|max:255',
            'description' => 'sometimes|string|nullable',
            'price'       => 'sometimes|numeric|min:0',
            'quantity'    => 'sometimes|integer|min:0',
            'active'      => 'sometimes|boolean',
        ];
    }
}

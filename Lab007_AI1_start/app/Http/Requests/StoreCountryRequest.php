<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:countries|max:50',
            'code' => 'required|string|unique:countries|max:3',
            'currency' => "required|string|max:30",
            'area' => "required|integer|min:0",
            'language' => "required|string|max:50",
        ];
    }
}

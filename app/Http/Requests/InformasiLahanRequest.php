<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformasiLahanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'min:3', 'max:50'],
            'deskripsi' => ['required', 'max:255', 'alpha'],
            'longitude' => ['required', 'regex:/^-?\d+\.\d+$/'], // float (positive or negative)
            'latitude' => ['required', 'regex:/^-?\d+\.\d+$/'], // float (positive or negative)
        ];
    }

    // public function messages()
    // {
    //     return [];
    // }
}

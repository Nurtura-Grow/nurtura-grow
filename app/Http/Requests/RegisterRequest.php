<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'nama' => 'Nama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan, pilih email lain.',
            'username.required' => 'Username tidak boleh kosong!',
            'username.unique' => 'Username sudah digunakan, pilih username lain.',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password harus minimal 4 karakter!',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong!',
            'password_confirmation.same' => 'Konfirmasi password harus sama dengan password.'
        ];
    }
}

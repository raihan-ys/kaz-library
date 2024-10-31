<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'current_password' => 'required|string|min:8|max:255',
			'new_password' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/|confirmed',
		];
	}

	/**
	 * Get the validation messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
    return [
			'current_password.required' => 'Password saat ini wajib diisi!',
			'current_password.string' => 'Password saat ini harus berupa string',
			'current_password.min' => 'Panjang password saat ini minimal 8 karakter!',
			'current_password.max' => 'Panjang password saat ini maksimal 255 karakter!',
			'new_password.regex' => 'Format password baru tidak valid!',
			'new_password.required' => 'Password baru wajib diisi!',
			'new_password.string' => 'Password baru harus berupa string',
			'new_password.min' => 'Panjang password baru minimal 8 karakter!',
			'new_password.max' => 'Panjang password baru maksimal 255 karakter!',
			'new_password.confirmed' => 'Konfirmasi gagal, password baru harus cocok!',
		];
	}
}

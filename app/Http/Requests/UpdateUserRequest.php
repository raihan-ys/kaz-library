<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name' => 'required|string|max:100',
			'profile_photo' => 'file|image|mimes:png|max:2048',
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
			'name.required' => 'Nama wajib diisi!',
			'name.string' => 'Nama harus berupa string',
			'name.max' => 'Panjang nama maksimal 100 karakter!',
			'profile_photo.file' => 'Foto profil harus berupa berkas!',
			'profile_photo.image' => 'Berkas harus berupa gambar!',
			'profile_photo.mimes' => 'Foto profil harus berupa berkas berformat PNG!',
			'profile_photo.max' => 'Foto profil tidak boleh lebih dari 2MB!',
		];
	}
}

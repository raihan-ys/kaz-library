<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'full_name' => 'required|string|max:100',
			'type_id' => 'required|integer|exists:member_types,id',
			'address' => 'required|string|max:255',
			'phone' => 'required|string|max:15|unique:members,phone',
			'email' => 'required|string|email|max:255|unique:members,email',
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
			'full_name.required' => 'Nama wajib diisi!',
			'full_name.max' => 'Panjang nama maksimal 100 karakter!',
			'full_name.string' => 'Nama harus berupa string!',
			'type_id.required' => 'Tipe anggota wajib diisi!',
			'type_id.integer' => 'Tipe anggota harus berupa angka!',
			'type_id.exists' => 'Tipe anggota yang dipilih tidak valid!',
			'address.required' => 'Alamat wajib diisi!',
			'address.string' => 'Alamat harus berupa string!',
			'address.max' => 'Panjang alamat maksimal 255 karakter!',
			'phone.required' => 'Nomor telepon wajib diisi!',
			'phone.string' => 'Nomor telepon harus berupa string!',
			'phone.max' => 'panjang nomor telepon maksimal 15 karakter!',
			'phone.unique' => 'Nomor telepon ini sudah terdaftar!',
			'email.required' => 'Email wajib diisi!',
			'email.string' => 'Email harus berupa string!',
			'email.email' => 'Mohon masukkan email yang valid!',
			'email.max' => 'Panjang email maksimal 255 karakter!',
			'email.unique' => 'Email ini sudah terdaftar!',
			'profile_photo.file' => 'Foto profil harus berupa berkas!',
			'profile_photo.image' => 'Berkas harus berupa gambar!',
			'profile_photo.mimes' => 'Foto profil harus berupa berkas berformat PNG!',
			'profile_photo.max' => 'Foto profil tidak boleh lebih dari 2MB!',
		];
	}
}

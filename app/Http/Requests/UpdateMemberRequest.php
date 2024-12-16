<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
      'full_name.string' => 'Nama harus berupa string',
      'type_id.required' => 'Tipe anggota wajib diisi!',
			'type_id.integer' => 'Tipe anggota harus berupa angka!',
			'type_id.exists' => 'Tipe anggota yang dipilih tidak valid!',
      'address.required' => 'Alamat wajib diisi!',
      'address.string' => 'Alamat harus berupa string!',
      'address.max' => 'Panjang alamat maksimal 255 karakter!',
      'profile_photo.file' => 'Foto profil harus berupa berkas!',
			'profile_photo.image' => 'Berkas harus berupa gambar!',
			'profile_photo.mimes' => 'Foto profil harus berupa berkas berformat PNG!',
			'profile_photo.max' => 'Foto profil tidak boleh lebih dari 2MB!',
    ];
  }
}

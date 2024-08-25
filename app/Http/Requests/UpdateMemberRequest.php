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
      'address' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
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
      'address.required' => 'Alamat wajib diisi!',
      'address.string' => 'Alamat harus berupa string!',
      'address.max' => 'Panjang alamat maksimal 255 karakter!',
      'email.required' => 'Email wajib diisi!',
      'email.string' => 'Email harus berupa string!',
      'email.email' => 'Mohon masukkan email yang valid!',
      'email.max' => 'Panjang email maksimal 255 karakter!',
    ];
  }
}

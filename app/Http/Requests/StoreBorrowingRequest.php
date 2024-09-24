<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'member_id' => 'required|integer|exists:members,id',
			'book_id' => 'required|integer|exists:books,id',
			'borrow_date' => 'required|date',
			'rental_price' => 'required|integer|min:0|max:99999',
			'librarian_id' => 'required|exists:users,id',
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
			'member_id.required' => 'Anggota wajib dipilih!',
			'member_id.integer' => 'Anggota tidak valid!',
			'member_id.exists' => 'Anggota tidak valid!',
			'book_id.required' => 'Buku wajib dipilih!',
			'book_id.integer' => 'Buku tidak valid!',
			'book_id.exists' => 'Buku tidak valid!',
			'borrow_date.required' => 'Tanggal peminjaman wajib diisi!',
			'borrow_date.date' => 'Tanggal peminjaman tidak valid!',
			'rental_price.required' => 'Biaya sewa wajib diisi!',
			'rental_price.integer' => 'Biaya sewa harus berupa angka!',
			'rental_price.min' => 'Harga sewa minimal 0!',
			'rental_price.max' => 'Harga sewa maksimal 99999!',
			'librarian_id.required' => 'Pustakawan wajib dipilih!',
			'librarian_id.exists' => 'Pustakawan tidak valid!',
		];
	}
}

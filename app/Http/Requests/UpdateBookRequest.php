<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'title' => 'required|string|max:100',
			'author' => 'required|string|max:100',
			'published_year' => 'required|integer',
			'category_id' => 'required|integer|exists:categories,id',
			'publisher_id' => 'required|integer|exists:publishers,id',
			'cover_image' => 'nullable|string',
			'stock' => 'required|integer|min:0|max:99',
			'rental_price' => 'required|integer|min:0|max:99999',
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
			'title.required' => 'Judul wajib diisi!',
			'title.max' => 'Panjang judul maksimal 100 karakter!',
			'title.string' => 'Judul harus berupa string',
			'author.required' => 'Penulis wajib diisi!',
			'author.string' => 'Penulis harus berupa string!',
			'author.max' => 'Panjang penulis maksimal 100 karakter!',
			'published_year.required' => 'Tahun terbit wajib diisi!',
			'published_year.integer' => 'Tahun terbit harus berupa angka!',
			'category_id.required' => 'Kategori wajib diisi!',
			'category_id.integer' => 'Kategori yang dipilih tidak valid!',
			'category_id.exists' => 'Kategori yang dipilih tidak valid!',
			'publisher_id.required' => 'Penerbit wajib diisi!',
			'publisher_id.integer' => 'Penerbit yang dipilih tidak valid!',
			'publisher_id.exists' => 'Penerbit yang dipilih tidak valid!',
			'cover_image.string' => 'Gambar sampul harus berupa string!',
			'stock.required' => 'Stok wajib diisi!',
			'stock.integer' => 'Stok harus berupa angka!',
			'stock.min' => 'Stok minimal 0!',
			'stock.max' => 'Stok maksimal 99!',
			'rental_price.required' => 'Harga sewa wajib diisi!',
			'rental_price.integer' => 'Harga sewa harus berupa angka!',
			'rental_price.min' => 'Harga sewa minimal 0!',
			'rental_price.max' => 'Harga sewa maksimal 99999!',
		];
	}
}

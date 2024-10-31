<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
	// Display current user's account setting.
	public function index($id)
	{
		// Find the specified user.
		$user = User::findOrFail($id);

		// Redirect to 404 page, if the authenticated user's ID does not match the provided ID.
		if(Auth::user()->id !== $user->id) {
			abort(404);
		}

		return view('pages.account.show', compact('user'));
	}

	// Show the form to edit current user's data.
	public function edit($id)
	{
		// Find the specified user.
		$user = User::findOrFail($id);

		// Redirect to 404 page, if the authenticated user's ID does not match the provided ID.
		if(Auth::user()->id !== $user->id) {
			abort(404);
		}
		
		return view('pages.account.edit', compact('user'));
	}

	// Update current user's data.
	public function update(UpdateUserRequest $request, $id)
	{
		// Find the specified user.
		$user = User::findOrFail($id);

		// Merge validated data with custom email validation.
		$validated = array_merge(
			$request->validated(),
			['email' => $request->email],
		);

		// Custom validation for email.
		$request->validate(
			[
				'email' => [
				'required',
				'string',
				'max:255',
				Rule::unique('users')->ignore($user->id),
				]
			],
			[
				'email.required' => 'Email wajib diisi!',
				'email.string' => 'Email harus berupa string!',
				'email.max' => 'panjang email maksimal 255 karakter!',
				'email.unique' => 'Email ini sudah terdaftar!',
			]
		);

		// If a file is uploaded as profile photo.
		if($request->hasFile('profile_photo')) {
			// Delete the original file to replace it.
			$old_photo = $user->profile_photo;
			if($old_photo) {
				Storage::disk('public')->delete($old_photo);
			}

			$file = $request->file('profile_photo');

			// Store the new file and get the path.
			$path = $file->store('profile_photos', 'public');

			// Save the path to the validated data.
			$validated['profile_photo'] = $path;
		}

		// Update user with all validated data.
		$user->update($validated);

		return redirect()->route('akun', $id)->with('success', 'Profil berhasil diupdate!');
	}

	// Show the form to change the user's password.
	public function editPassword($id)
	{
		// Find the specified user.
		$user = User::findOrFail($id);

		// Redirect to 404 page, if the authenticated user's ID does not match the provided ID.
		if(Auth::user()->id !== $user->id) {
			abort(404);
		}

		return view('pages.account.edit-password');
	}

	// Update the user's password.
	public function updatePassword(UpdatePasswordRequest $request, $id)
	{
		// Check if the specified user exist.
		$user = User::findOrFail($id);

		$validated = $request->validated();

		$validated['password'] = bcrypt($request->new_password);
		
		// Update user with all validated data.
		$user->update($validated);

		// Log out the user
		Auth::logout();
		
		return redirect()->route('login')->with('success', 'Password berhasil diubah!');
	}
}

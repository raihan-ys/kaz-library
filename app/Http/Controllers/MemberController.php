<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberType;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    // Display all members.
    public function index()
    {
        // Select all from members table join with member types table.
        $members = Member::join('member_types', 'members.type_id', '=', 'member_types.id')
            ->select('members.*', 'member_types.name as type_name')
            ->orderBy('full_name')
            ->get();

        $member_types = MemberType::all();

        return view('pages.members.index', compact('members', 'member_types'));
    }

    // Show a specified member detail.
    public function show($id)
    {
        // Find the specified member.
        $member = DB::table('members')
            ->join('member_types', 'members.type_id', '=', 'member_types.id')
            ->select('members.*', 'member_types.name as type_name')
            ->where('members.id', $id)
            ->first();

        return view('pages.members.show', compact('member'));
    }

    // Store a newly created member in storage.
    public function store(StoreMemberRequest $request)
    {
        // Input validation.
		$validated = $request->validated();
        
        // Handle file upload.
		if($request->hasFile('profile_photo')) {
			$file = $request->file('profile_photo');

			// Store the file and get the path.
			$path = $file->store('profile_photos', 'public');
			// Save the path to the validated data.
			$validated['profile_photo'] = $path;
		}

		// Create new member with validated data.
		try {
			$member = Member::create($validated);
			$id = $member->id;
		} catch(\Illuminate\Validation\ValidationException $e) {
			// Set file metadata in session to display to user.
			session()->flash('file_metadata', [
				'name' => $file->getClientOriginalName(),
				'size' => $file->getSize(),
				'type' => $file->getClientMimeType(),
			]);
			return redirect()->back()->withErrors($e->validator)->withInput();
		}

		return redirect()->route('anggota.show', $id)->with('success', 'Anggota berhasil ditambahkan!');
    }

    // Show the form for editing the specified member.
    public function edit($id)
    {
        // Check if the specified member exist.
        Member::findOrFail($id);

        // Find the specified member.
        $member = DB::table('members')
            ->join('member_types', 'members.type_id', '=', 'member_types.id')
            ->select('members.*', 'member_types.*')
            ->where('members.id', $id)
            ->first();

        $member_types = MemberType::all();
        
		return view('pages.members.edit', compact('id', 'member', 'member_types'));
    }

    // Update the specified member.
    public function update(UpdateMemberRequest $request, $id)
    {
        // Find the specified member.
		$member = Member::findOrFail($id);

        // Merge validated data with custom phone number and email validation.
        $validated = array_merge(
			$request->validated(),
			['phone' => $request->phone],
            ['email' => $request->email],
		);

        // Custom validation for phone number.
        $request->validate(
            [
                'phone' => [
                    'required',
                    'string',
                    'max:15',
                    Rule::unique('members')->ignore($member->id),
                ]
            ], 
            [
                'phone.required' => 'Nomor telepon wajib diisi!',
                'phone.string' => 'Nomor telepon harus berupa string!',
                'phone.max' => 'panjang nomor telepon maksimal 15 karakter!',
                'phone.unique' => 'Nomor telepon ini sudah terdaftar!',
            ]
        );

        // Custom validation for email.
        $request->validate(
            [
                'email' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('members')->ignore($member->id),
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
			$old_photo = $member->profile_photo;
			if($old_photo) {
				Storage::disk('public')->delete($old_photo);
			}

			$file = $request->file('profile_photo');

			// Store the new file and get the path.
			$path = $file->store('profile_photos', 'public');

			// Save the path to the validated data.
			$validated['profile_photo'] = $path;
		}

		// Update member with all validated data.
		$member->update($validated);
		
		return redirect()->route('anggota.show', $id)->with('success', 'Anggota berhasil diperbarui!');
    }

    // Remove the specified member.
    public function destroy($id)
    {
        // Find the specified member.
        $member = Member::findOrFail($id);

        // Delete member's cover image.
		if($member->profile_photo) {
			Storage::disk('public')->delete($member->profile_photo);
		}

        // Remove the specified member.
        $member->delete();

        return redirect()->route('anggota')->with('success', 'Anggota berhasil dihapus!');
    }
}

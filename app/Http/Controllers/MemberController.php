<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    // Display all members.
    public function index()
    {
        $data['members'] = Member::all();
        $data['title'] = 'Daftar Anggota';
        return view('pages.members.index', $data);
    }
    
    // Store a newly created member in storage.
    public function store(StoreMemberRequest $request)
    {
        // Input validation.
		$validated = $request->validated();

		// Create new member with validated data.
		Member::create($validated);

		return redirect()->route('anggota')->with('success', 'Anggota berhasil ditambahkan!');
    }

    // Display the specified member.
    public function show($id)
    {
        $data['member'] = Member::find($id);
        $data['title'] = 'Detail Anggota: '.$data['member']->full_name;
        return view('pages.members.show', $data);
    }

    // Show the form for editing the specified member.
    public function edit($id)
    {
        $data['member'] = Member::find($id);
		$data['title'] = 'Edit Anggota';
		return view('pages.members.edit', $data);
    }

    // Update the specified membere.
    public function update(UpdateMemberRequest $request, $id)
    {
        // Find specified member.
		$member = Member::findOrFail($id);

        // Merge validated data with custom phone number validation.
        $validated = array_merge(
			$request->validated(),
			['phone' => $request->phone],
		);

        // Custom validation for phone number.
        $request->validate([
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
			'phone.unique' => 'Nomor telepon ini sudah digunakan oleh anggota lain!',
        ]);

		// Update member with all validated data.
		$member->update($validated);
		
		return redirect()->route('anggota')->with('success', 'Data anggota berhasil diupdate!');
    }

     /**
     * Remove the specified member from storage.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find specified member.
        $member = Member::findOrFail($id);

        // Remove specified member.
        $member->delete();

        return redirect()->route('anggota')->with('success', 'Anggota berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['members'] = Member::all();
        $data['title'] = 'Daftar Anggota';
        return view('pages.members.index', $data);
    }
    
    /**
     * Store a newly created member in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
 {
    $request->validate([
    'full_name' => 'required|string|max:255',
    'address' => 'required|string|max:255',
    'phone' => 'required|string|max:15|unique:members,phone',
    'email' => 'required|string|email|max:255',
    ]);
    Member::create($request->all());
    return redirect()->route('members.index')->with('success', 'Member
   created successfully.');
    }
    /**
    * Display the specified member.
    *
    * @param \App\Models\Member $member
    * @return \Illuminate\Http\Response
    */
    public function show(Member $member)
    {
    return view('pages.members.show', compact('member'));
    }
    /**
    * Show the form for editing the specified member.
    *
    * @param \App\Models\Member $member
    * @return \Illuminate\Http\Response
    */
    public function edit(Member $member)
    {
    return view('pages.members.edit', compact('member'));
    }
    /**
    * Update the specified member in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\Member $member
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Member $member)
    {
    $request->validate([
    'full_name' => 'required|string|max:255',
    'address' => 'required|string|max:255',
    'phone' => 'required|string|max:15|unique:members,phone,' .
    $member->id,
     'email' => 'required|string|email|max:255',
     ]);
     $member->update($request->all());
     return redirect()->route('members.index')->with('success', 'Member
    updated successfully.');
     }
     /**
     * Remove the specified member from storage.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
     public function destroy(Member $member)
     {
     $member->delete();
     return redirect()->route('members.index')->with('success', 'Member
    deleted successfully.');
     }
    }
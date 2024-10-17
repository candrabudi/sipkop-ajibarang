<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('members.index', ['members' => Member::all()]);
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $store = new Member();
        $store->name = $request->name;
        $store->address = $request->address;
        $store->gender = $request->gender;
        $store->job = $request->job;
        $store->phone = $request->phone;
        $store->birth_place = $request->birth_place;
        $store->birth_date = $request->birth_date;
        $store->status = $request->status == "on" ? 1 : 0;
        $store->save();
        return redirect()->route('member.list');
    }

    public function edit($id)
    {
        $member = Member::find($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {

        $member = Member::find($id);
        $member->name = $request->name;
        $member->address = $request->address;
        $member->gender = $request->gender;
        $member->job = $request->job;
        $member->phone = $request->phone;
        $member->birth_place = $request->birth_place;
        $member->birth_date = $request->birth_date;
        $member->status = $request->status == "on" ? 1 : 0;
        $member->save();

        return redirect()->route('member.list');
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('members.index');
    }
}

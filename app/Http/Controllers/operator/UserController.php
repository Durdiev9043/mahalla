<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $uuid = Str::uuid()->toString();
        $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
        $request->img->move(public_path('../public/storage/galereya/'), $fileName);
        User::create([
            'ismi'=>$request->ismi,
            'familyasi'=>$request->familyasi,
            'otasini_ismi'=>$request->otasini_ismi,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
            'role'=>3,
            'position_id'=>$request->position_id,
            'village_id'=>$request->village_id,
            'region_id'=>Auth::user()->region_id,
            'district_id'=>Auth::user()->district_id,
            'img' => $fileName,
        ])->assignRole(3);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

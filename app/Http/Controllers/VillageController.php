<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VillageController extends Controller
{

    public function index()
    {
        $villages=Village::where('district_id',Auth::user()->district_id)->get();
        return view('operator.village.index',['villages'=>$villages]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Village::create([
            'name'=>$request->name,
            'region_id'=>Auth::user()->region_id,
            'district_id'=>Auth::user()->district_id
        ]);
        return redirect()->back();
    }

    public function show(Village $village)
    {
        $villages=Village::where('district_id',Auth::user()->district_id)->get();
        $users=User::where('village_id',$village->id)->get();
        $loc=Location::where('village_id',$village->id)->first();
        return view('operator.village.show',['users'=>$users,'loc'=>$loc,'village'=>$village,'villages'=>$villages]);
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

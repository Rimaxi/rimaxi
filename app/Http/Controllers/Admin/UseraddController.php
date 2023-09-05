<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UseraddRequest;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Hobby;
use App\Models\State;
use App\Models\User;
use App\Models\UserAdress;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UseraddController extends Controller
{
    public function index(UserDataTable $table)
    {
        return $table->render('admin.backend.users.index');
    }
    // public function store(UseraddRequest $request)
    // {
    //     dd(1);
    //     $hobbies = implode(',', $request->hobbies);

    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->dob = $request->dob;
    //     $user->password = Hash::make($request->password);
    //     $user->phone = $request->phone;
    //     $user->hobbies = $hobbies;
    //     $user->country_id = $request->country_id;
    //     $user->state_id = $request->state_id;
    //     $user->city_id = $request->city_id;
    //     $user->save();

    //     foreach ($request->input('address') as  $value) {
    //         UserAdress::create(['user_id' => $user->id,'useraddress' => $value]);
    //     }
    //     return response()->json(['success' => 'done']);
    // }
    public function edit($id)
    {
        $user = User::find($id);
        $hobbies = Hobby::all();
        $countries = Country::all();
        $state = State::all();
        $city = City::all();
        return view('admin.backend.users.edit', compact('user', 'hobbies', 'countries', 'state', 'city'));
    }

    public function userUpdate(UseraddRequest $request, $id)
    {
        $hobbies = implode(',', $request->hobbies);
        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->hobbies = $hobbies;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->update();
        return response()->json();
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Providers\RouteServiceProvider;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Client\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use \Illuminate\Foundation\Auth\RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country-dd' => 'required',
            'state-dd' => 'required',
            'city-dd' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    protected function create(array  $data )
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'dob' => $data['dob'],
            'age' => $data['dob'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'country_id' => $data['countr_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
        ]);
    }
    public function showRegistrationForm()
    {
        $countries = Country::all();
        $state = State::all();
        $city = City::select('city')->get(['id', 'city']);
        return view('auth.register', compact('countries', 'state', 'city'));
    }
}

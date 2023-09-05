<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Hobby;
use App\Models\State;
use App\Models\User;
use App\Models\UserAdress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function front()
    {
        $countries = Country::all();
        $state = State::all();
        $city = City::select('city')->get(['id', 'city']);
        $hobbies = Hobby::all();
        return view('front.create', compact('countries', 'state', 'city', 'hobbies'));
    }

    public function store(UserRequest $request)
    {
        $hobbies = implode(',', $request->hobbies);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->hobbies = $hobbies;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->save();

        foreach ($request->input('useraddress') as  $value) {
            UserAdress::create(['user_id' => $user->id, 'useraddress' => $value]);
        }
        return response()->json();
    }
    public function login()
    {
        return view('front.login');
    }

    public function userlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('user')->attempt($credentials)) {
            // $request->session()->regenerate();
            return redirect()->route('home')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showForgetPasswordForm()
    {
        return view('front.emaillink');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('front.forgetpasslink', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('status', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {
        return view('front.resetpass', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
            ])
            ->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        } else {

            $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
        }
        //   DB::table('password_resets')->where(['email'=> $request->email])->first();
        return redirect()->route('loginuser')->with('status', 'Your password has been changed!');
    }
    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect()->route('loginuser');
        }
    }
}

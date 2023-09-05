<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index(UserDataTable $table)
    {
        // $data['states'] = DB::table('state');
        return $table->render('admin.backend.users.index');
    }
    public function delete($id)
    {
        $data = User::find($id);
        if ($data) {
            if ($data->delete()) {
                $response['success'] = 1;
                $response['msg'] = 'Delete successfully';
            } else {
                $response['success'] = 0;
                $response['msg'] = 'Error deleting user.';
            }
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response);
    }
    public function sidebar()
    {
        return view('admin.layouts.sidebar');
    }
    public function master()
    {
        return view('admin.layouts.master');
    }

    public function login(Request $request)
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        $admin = Admin::where('email', $email)->first();

        $password = Hash::check($request->password, $admin->password);

        if ($password) {
            Auth::guard('admin')->attempt(
                ['email' => $request->email, 'password' => $request->password]
            );

            return redirect()->route('admin.dashboard');
            // dashboard redirect

        } else {
            return redirect()->back()->withInput()->withErrors(['password' => 'Wrong password']);
            // send wrong password error
        }
    }
    public function dashboard()
    {
        return view('admin.layouts.master');
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    }
}

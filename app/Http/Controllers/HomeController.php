<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Write;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $write = Write::all();
        $post = Post::all();

        if ($request->ajax() || $request->isJson()) {
            $post = view('post-list')->with('post', $post)->render();
            return response()->json();
        } else {
            return view('home', compact('post', 'write'));
        }
    }
}

    // public function getPosts(Request $request)
    // {
    //     $write = $request->input('write_id');
    //     $post = Post::where('write_id', $write)->get(['title', 'description']);

    //     return response()->json(['post' => $post]);
    // }

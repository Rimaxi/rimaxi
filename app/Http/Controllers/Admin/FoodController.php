<?php

namespace App\Http\Controllers\Admin;


use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $food = Food::all();
        return view('admin.backend.categories.index', compact('food'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $food = new Food();
        $food->name = $request->name;
        $food->description = $request->description;
        $food->cousin = $request->cousin;
        $food->save();
        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        if (!empty($food)) {
            $food->update(['status' => $request->status == 1 ? 0 : 1]);
            return response()->json(['message' => 'Status updated successfully']);
        } else {
            return response()->json(['message' => 'food not found', "status" => 422],);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $food = Food::find($id);
        return view('admin.backend.categories.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $food = Food::find($id);
        return view('admin.backend.categories.edit', compact('food'));
    }


    public function update(Request $request, string $id)
    {
        $food = Food::find($id);
        $food->name = $request->input('name');
        $food->description = $request->input('description');
        $food->cousin = $request->input('cousin');
        $food->update();

        return redirect()->route('food.index')->with('status', 'Food updated scuccessfully');
    }


    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('food.index')->with('status', "Food deleted successfully");
    }
    public function search(Request $request)
    {
        $food = $request->input('search');
        $food = Food::where('name', 'LIKE', '%' . $food . "%")->get();
        return response()->json(['data' => $food]);
    }
}
// $food = DB::table('users')->where('name', 'LIKE', '%' . $request->search . "%")->get();

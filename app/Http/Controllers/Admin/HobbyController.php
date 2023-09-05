<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HobbiesDataTable;
use App\Http\Requests\HobbyRequest;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HobbiesDataTable $table)
    {
        return $table->render('admin.backend.users.hobby');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HobbyRequest $request)
    {
       $hobbies = new Hobby;
       $hobbies->hobbies = $request->input('hobbies');
       $hobbies->save();
       return response()->json(['message' => 'Hobbies added successfully']);

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

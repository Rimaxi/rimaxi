<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Routing\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CountryDataTable $table)
    {
        return $table->render('admin.backend.users.country');
    }

    public function create()
    {
        return view('admin.country.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {

        $request->validate($request->rules());

        $country = new Country;
        $country->countryname = $request->input('countryname');
        $country->save();

        return response()->json(['message' => 'Country added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
    public function updateCountryStatus($id)
    {
        $country = Country::find($id);

        if ($country) {
            $newStatus = $country->status == 1 ? 0 : 1;
            $country->update(['status' => $newStatus]);

            // Assuming you want to redirect back to the index view
            return redirect()->route('country.index')->with('success', 'Status updated successfully.');
        }

        return redirect()->route('country.index')->with('error', 'Country not found.');
    }
}

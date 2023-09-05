<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDataTable;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CityDataTable $table)
    {
        return $table->render('admin.backend.users.city');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $state = State::all();
        return view('admin.city.create', ['countries' => $countries],['state' => $state]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city' => [
                'required',
                Rule::unique('city')->where(function ($query) use ($request) {
                    return $query->where('state_id', $request->input('state_id'))
                                 ->where('city', $request->input('city'));
                }),
            ],
        ]);
        $city = new City();
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id ;
        $city->city = $request->city;
        $city->save();

        return response()->json();
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

    public function getcity(Request $request)
    {

        $city = City::where('state_id', $request->city_id)->get(['id', 'city']);
        return response()->json(['city' => $city]);
    }
    public function updateCityStatus($id)
    {
        $city = City::find($id);

        if ($city) {
            $newStatus = $city->status == 1 ? 0 : 1;
            $city->update(['status' => $newStatus]);

            // Assuming you want to redirect back to the index view
            return redirect()->route('city.index')->with('success', 'Status updated successfully.');
        }

        return redirect()->route('city.index')->with('error', 'city not found.');
    }
}

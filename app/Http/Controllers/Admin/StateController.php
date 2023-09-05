<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StateDataTable;
use App\Http\Requests\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StateDataTable $table)
    {
        return $table->render('admin.backend.users.state');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.state.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        $state = new State();
        $state->country_id = $request->country_id;
        $state->state = $request->state;
        $state->save();

        return response()->json(['message' => 'state added successfully']);
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

    public function getState(Request $request)
    {

        $state = State::where('country_id', $request->country_id)->get(['id', 'state']);
        return response()->json(['state' => $state]);
    }
    public function updateStateStatus($id)
    {
        $state = State::find($id);

        if ($state) {
            $newStatus = $state->status == 1 ? 0 : 1;
            $state->update(['status' => $newStatus]);

            // Assuming you want to redirect back to the index view
            return redirect()->route('state.index')->with('success', 'Status updated successfully.');
        }

        return redirect()->route('state.index')->with('error', 'Country not found.');
    }
}

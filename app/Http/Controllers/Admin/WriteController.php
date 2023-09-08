<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WriteDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WriteRequest;
use App\Models\Write;
use Illuminate\Http\Request;

class WriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WriteDataTable $table)
    {

        return $table->render('admin.write.writeindex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $write = new Write();
        return view('admin.write.create', compact('write'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WriteRequest $request)
    {
        $write = new Write();
        $write->write = $request->write;
        $write->email = $request->email;
        $write->save();
        return redirect()->back();
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
        $write = Write::find($id);
        return view('admin.write.edit', compact('write'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $write = Write::find($id);
        $write->write = $request->write;
        $write->email = $request->email;
        $write->status = $request->status;
        $write->update();
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $write = Write::find($id);

        if ($write) {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        } else {
            if ($write->delete()) {
                $response['success'] = 1;
                $response['msg'] = 'Delete successfully';
            } else {
                $response['success'] = 0;
                $response['msg'] = 'Error deleting write.';
            }
        }

        return response()->json($response);
    }
    public function toggleStatus(Request $request)
    {

        $write = Write::findOrFail($request->input('write'));
        $status = $request->input('status');
        dd($status);
        $write->update(['status' => $status]);

        return response()->json(['status' => 'success']);
    }

    // public function activateWriter($id)
    // {
    //     $write = Write::findOrFail($id);
    //     $write->update(['is_active' => true]);

    //     return redirect()->route('writers.index')->with('success', 'Writer activated successfully');
    // }

    // public function deactivateWriter($id)
    // {
    //     $write = Write::findOrFail($id);
    //     $write->update(['is_active' => false]);

    //     return redirect()->route('writers.index')->with('success', 'Writer deactivated successfully');
    // }
}

<?php

namespace App\Http\Controllers;

use App\Models\FeeList;
use Illuminate\Http\Request;

class FeeListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeLists = FeeList::all();
        return view('admin.fee-list', compact('feeLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function toggleStatus($id)
    {
        $feeList = FeeList::findOrFail($id);

        // Toggle the status
        $feeList->status = $feeList->status === 'active' ? 'inactive' : 'active';

        // Save the changes
        $feeList->save();

        return response()->json(['status' => $feeList->status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $feeList = new FeeList();

        $feeList->feeName =  $request->input('feeName');
        $feeList->amount = $request->input('amount');
        $feeList->gradeLevel = $request->input('gradeLevel');
        $feeList->classType = $request->input('classType');
        $feeList->status = 'active';
        $feeList->save();

        notify()->success('Fee added successfully!');
        return back();
    }

    public function setStatus(){

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

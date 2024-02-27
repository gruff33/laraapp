<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domain;

class DomainAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return response()->json(Domain::all());
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $NewDomain=Domain::firstOrCreate([
            'name' => $request->name
        ]);
        return response()->json($NewDomain);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return response()->json(Domain::where('id',$id)->firstOrFail());
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

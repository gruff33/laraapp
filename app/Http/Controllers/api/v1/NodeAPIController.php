<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Node;
use App\Models\NodeAttr;
use App\Models\OperatingSystem;
use App\Models\OperatingSystemVersion;

class NodeAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(node::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        //
        $Os=OperatingSystem::firstOrCreate([
            'name' => $request->osname,
        ]);
       
        echo "OS ID : ".$Os->id;
        
        $OsVersion=OperatingSystemVersion::firstOrCreate([
            'name' => $request->osversion,
        ]);
    

        $NewAsset=Node::updateOrCreate([
            'name'         => $request->name,
            'uuid' => $request->uuid,
        ],[
        //    'fqdn'         => $request->domain,
            'serialnumber' => $request->serialnumber,
            'description'  => $request->description,
            'machineid'    => $request->machineid,
            'last_checkin' => now()
        ]);
        $NewAsset=Node::where('uuid',$request->uuid)->
                        where('name',$request->name)->
                        firstOrFail();

        $NewCOSV=NodeOperatingSystemVersion::updateOrCreate([
            'compute_id'   => $NewAsset->id,
            'os_id'        => $Os->id,
            'version_id'   => $OsVersion->id,
        ],[
            'last_checkin' => now(),
        ]);
        return response()->json($NewAsset); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

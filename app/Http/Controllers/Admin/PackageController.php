<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function getPackage()
    {
        $packages = Package::all();

        if ($packages->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No packages found'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $packages
        ]);
    }

    public function createPackage(Request $request)
    {
       $data = $request->all();

       $package= Package::create($data);

       return response()->json([
           'success' => true,
           'data' => $package
       ]);
    }


    public function updatePackage(Request $request,$id)
    {
        $package = Package::find($id);
        $package->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $package
        ]);
    }
    public function deletePackage($id)
    {
        $package = Package::find($id);
        $package->delete();
        return response()->json([
            'success' => true,
            'message' => 'Package deleted successfully'
        ]);
    }

}

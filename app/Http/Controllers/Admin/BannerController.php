<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function getBanner()
    {

        $data = Banner::all();

        return response()->json([
            'success' => true,
            "message" => "Banner data fetched successfully",
            'data' => $data
        ]);


    }
    public function getBannerById($id)
    {
        $data = Banner::where('id', $id)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'No data found'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    public function createBanner(Request $request)
    {

         $data= $request->all();
         $banner=Banner::create($data);

        return response()->json([
            'success' => true,
            'data' => $banner,
            'message' => 'Banner created successfully'
        ]);
    }
    public function updateBanner(Request $request, $id)
    {
        $banner = Banner::where('id', $id)->first();
        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'No data found'
            ]);
        }
        $banner->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $banner,
            'message' => 'Banner updated successfully'
        ]);
    }
       public function deleteBanner($id)
        {
            $banner = Banner::where('id', $id)->first();
            if (!$banner) {
                return response()->json([
                    'success' => false,
                    'message' => 'No data found'
                ]);
            }
            $banner->delete();
            return response()->json([
                'success' => true,
                'message' => 'Banner deleted successfully'
            ]);
        }


}

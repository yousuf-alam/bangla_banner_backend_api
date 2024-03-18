<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Repositories\S3FileRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userRegister(Request $request)
    {
        if (User::where('phone', $request->phone)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number already exists'
            ]);
        }
        $data= new User();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->password= bcrypt($request->password);
        $data->save();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function userLogin(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();


        if(!$user)
        {
            return response()->json([
                "success"=>false,
                "message"=>"User not found"
            ],Response::HTTP_NOT_FOUND);
        }

        if (Hash::check($request->password, $user->password)) {
            $data = [

                "id" => $user->id,
                "name" => $user->name,
                "phone" => $user->phone,
                "token" => $user->createToken('authToken')->plainTextToken,

            ];
            return response()->json([
                "success" => true,
                "message" => "Logged in Successfully",

                "data" => $data
            ], Response::HTTP_OK);
        }
        return response()->json([
            "success" => false,
            "message" => "Password Not Matched",
        ], Response::HTTP_UNAUTHORIZED);

    }

    public function userLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "success" => true,
            "message" => "Logged out successfully"
        ], Response::HTTP_OK);
    }

    public function userProfile(Request $request)
    {
        $user=Auth::user();
        $is_subscribed=true;
        $balance=5;
        $total_used=0;
        $data=[
            "id"=>$user->id,
            "name"=>$user->name,
            "phone"=>$user->phone,
            "is_subscribed"=>$is_subscribed,
            "balance"=>$balance,
            "total_used"=>$total_used,
        ];

        return response()->json([
            "success" => true,
            "message" => "User Profile",
            "data" => $data
        ], Response::HTTP_OK);
    }
    public function debitUserWallet()
    {
        $user=Auth::user();
        $user_wallet=$user->UserWallet;
        $user_wallet->debit=$user_wallet->debit+1;
        $user_wallet->credit=$user_wallet->credit-1;
        $user_wallet->balance=$user_wallet->balance-1;
        $user_wallet->total_used=$user_wallet->total_used+1;
        $user_wallet->save();
        return response()->json([
            "success" => true,
            "message" => "Wallet Debited Successfully",
            "data" => $user_wallet
        ], Response::HTTP_OK);

    }
}

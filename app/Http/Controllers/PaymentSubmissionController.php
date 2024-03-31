<?php

namespace App\Http\Controllers;

use App\Models\PaymentSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PaymentSubmissionController extends Controller
{
    public function paymentSubmission(Request $request)
    {
        $user=Auth::user();

        if(!$user)
        {
            return response()->json([
                "success"=>false,
                "message"=>"User not found"
            ],Response::HTTP_NOT_FOUND);
        }
        $item= PaymentSubmission::where('trans_id',$request->trans_id)->first();
        if($item)
        {
            return response()->json([
                "success"=>false,
                "message"=>"Transaction ID already exists"
            ],Response::HTTP_CONFLICT);
        }
        $data = new PaymentSubmission();
        $data->user_id = $user->id;
        $data->amount = $request->amount ?? 30;
        $data->payment_method = $request->payment_method ?? 'bkash';
        $data->trans_id = $request->trans_id;
        $data->payment_number = $request->payment_number;
        $data->status = 'pending';
        $data->save();
        return response()->json([
            'message' => 'Payment submitted successfully',
            'success' => true,
            'data' => $data
        ], Response::HTTP_CREATED);




    }

    public function getPayment()
    {
        $data=PaymentSubmission::all()->where('status','pending');

        if($data->isEmpty())
        {
            return response()->json([
                "success"=>false,
                "message"=>"No payment found"
            ],Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'message' => 'Payment list',
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function getPaymentById($id)
    {
        $data=PaymentSubmission::find($id);

        if(!$data)
        {
            return response()->json([
                "success"=>false,
                "message"=>"Payment not found"
            ],Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'message' => 'Payment details',
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function updatePayment(Request $request,$id)
    {
        $data=PaymentSubmission::find($id);

        if(!$data)
        {
            return response()->json([
                "success"=>false,
                "message"=>"Payment not found"
            ],Response::HTTP_NOT_FOUND);
        }
        $data->status=$request->status;
        $data->message=$request->message;
        $data->save();
        return response()->json([
            'message' => 'Payment updated successfully',
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }
}

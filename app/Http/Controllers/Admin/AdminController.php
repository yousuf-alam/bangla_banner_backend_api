<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSubmission;
use App\Models\User\User;
use App\Services\UserWalletService;
use App\Services\WalletHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',
            'phone' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->status = 'active';
        $user->created_at = now();
        $response = $user->save();

        if ($response) {
            return back()->with('success', 'You have registered successfully');
        } else {
            return back()->with('fail', 'Something Wrong');
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('/console');
            } else {
                return back()->with('fail', 'Password not matches');
            }
        } else {
            return back()->with('fail', 'This email is not registered');
        }
    }

    public function dashboard()
    {
        $data = [];
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::has('loginId'))->first();
        }

        return view('dashboard', compact('data'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
    }

    public function allPayments()
    {
        $allPayments = PaymentSubmission::with('user')->get();

        return view('payments.allpayment', compact('allPayments'));
    }

    public function pendingPayments()
    {
        $pendingPayments = PaymentSubmission::with('user')->where('status', 'pending')->get();

        return view('payments.pendingpayment', compact('pendingPayments'));
    }

    public function editPayment($id)
    {
        $payment = PaymentSubmission::findOrFail($id);

        return view('payments.editpayment', compact('payment'));
    }

    public function updatePayment(Request $request, $id)
    {
        $payment = PaymentSubmission::findOrFail($id);

        $payment->fill($request->only(['payment_method', 'trans_id', 'payment_number', 'amount', 'status']));

        $payment->save();

        if ($payment->status == 'pending') {
            return redirect()->route('pending.payments')->with('success', 'Payment updated successfully');
        } else {
            return redirect()->route('all.payments')->with('success', 'Payment updated successfully');
        }
    }

    public function approvePayment(Request $request)
    {

        $payment = json_decode($request->payment, true);
        $paymentId = $payment['id'];
        $userId = $payment['user']['id'];
        $user = User::findOrFail($userId);
        $amount = $payment['amount'];
        $payment = PaymentSubmission::findOrFail($paymentId);
        $payment->message = 'Payment is Successfull';
        $payment->save();

        UserWalletService::creditUserWallet($user, $amount);

        WalletHistoryService::createCreditData($user, $amount);


        if ($payment->status == 'pending') {
            return redirect()->route('pending.payments')->with('success', 'Payment updated successfully');
        } else {
            return redirect()->route('all.payments')->with('success', 'Payment updated successfully');
        }
    }

    public function rejectPayment(Request $request){

        $payment = json_decode($request->payment, true);
        $paymentId = $payment['id'];
        $payment = PaymentSubmission::findOrFail($paymentId);
        $payment->message = 'Payment is Rejected';
        $payment->save();

        if ($payment->status == 'pending') {
            return redirect()->route('pending.payments')->with('success', 'Payment updated successfully');
        } else {
            return redirect()->route('all.payments')->with('success', 'Payment updated successfully');
        }

    }
}

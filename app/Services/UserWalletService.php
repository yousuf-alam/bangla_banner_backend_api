<?php

namespace App\Services;

class UserWalletService
{
    public static function creditUserWallet($user, $amount)
    {
        $wallet = $user->UserWallet;
        $wallet->credit += $amount;
        $wallet->balance += $amount;
        $wallet->save();
    }

    public static function debitUserWallet($user, $amount)
    {
        $wallet = $user->UserWallet;
        $wallet->debit += $amount;
        $wallet->credit -= $amount;
        $wallet->balance -= $amount;
        $wallet->total_used += $amount;
        $wallet->save();
    }



}

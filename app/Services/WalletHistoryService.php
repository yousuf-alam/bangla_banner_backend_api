<?php

namespace App\Services;

use App\Models\User\WalletHistory;

class WalletHistoryService
{

    public static function createDebitData($user)
    {

        $walletHistory = new WalletHistory();
        $walletHistory->type = 'debit';
        $walletHistory->user_id = $user->id;
        $walletHistory->debit = 1;
        $walletHistory->credit = 0;
        $walletHistory->balance = $walletHistory->balance-1;
        $walletHistory->message = "You generated 1 image";
        $walletHistory->save();
    }
    public static function createCreditData($user,$amount)
    {

        $walletHistory = new WalletHistory();
        $walletHistory->type = 'credit';
        $walletHistory->user_id = $user->id;
        $walletHistory->debit = 0;
        $walletHistory->credit = $amount;
        $walletHistory->balance = $walletHistory->balance+$amount;
        $walletHistory->message = "You bought " . $amount . " credits";
        $walletHistory->save();
    }

}

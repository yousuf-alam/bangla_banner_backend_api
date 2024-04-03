<?php

namespace App\Models;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'trans_id',
        'payment_number',
        'amount',
        'status',
        'message'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

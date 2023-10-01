<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    public $timestamps = false;

    protected $table = 'payments_status';

    protected $fillable = [
        'name'
    ];

    use HasFactory;
}

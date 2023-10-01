<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps = false;

    protected $table = 'currencies';

    protected $fillable = [
        'country_iso_code',
        'currency_iso_code'
    ];

    use HasFactory;
}

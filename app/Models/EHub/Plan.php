<?php

namespace App\Models\EHub;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment\Currency;

class Plan extends Model
{
    protected $table = 'plans';

    use HasFactory;

    public function currencies()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}

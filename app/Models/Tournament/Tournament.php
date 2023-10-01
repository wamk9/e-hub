<?php

namespace App\Models\Tournament;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public $timestamps = false;

    protected $table = 'tournaments';

    protected $fillable = [
        'name',
        'description',
        'price',
        'subscription_limit',
        'banner_image',
        'logo_image',
        'category_id',
        'league_id'
    ];

    use HasFactory;
}

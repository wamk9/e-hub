<?php

namespace App\Models\Tournament\Point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointCategory extends Model
{
    public $timestamps = false;

    protected $table = 'point_categories';

    protected $fillable = [
        'name',
        'description',
        'type'
    ];

    protected $hidden = [
        'id'
    ];

    use HasFactory;
}

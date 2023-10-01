<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHierarchy extends Model
{
    public $timestamps = false;

    protected $table = "users_hierarchies";

    protected $fillable = [
        'user_id',
        'league_id',
        'hierarchy_id'
    ];

    /*protected $hidden = [
        'user_id',
        'league_id',
        'hierarchy_id'
    ];*/

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name', 'description', 'image'
    ];

    protected $hidden = [
        'hidden'
    ];

    use SoftDeletes;
    use HasFactory;

    public function members()
    {
        //if (Auth::check())
            //return $this->belongsToMany(User::class, 'teams_members', 'team_id', 'member_id')->wherePivot('team_id', '=', $this->id)->withPivot(['is_admin']);

        return $this->belongsToMany(User::class, 'teams_members', 'team_id', 'member_id')->wherePivot('team_id', '=', $this->id)->withPivot(['is_admin']);
    }
}

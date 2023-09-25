<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'teams_members';

    protected $fillable = [
        'member_id', 'team_id', 'is_admin'
    ];

    use HasFactory;

    public static function countTeamMembers($team_id)
    {
        return TeamMember::where('team_id', '=', $team_id)->get()->count();
    }
}

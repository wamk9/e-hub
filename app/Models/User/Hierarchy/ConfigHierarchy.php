<?php

namespace App\Models\User\Hierarchy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigHierarchy extends Model
{
    public $timestamps = false;

    protected $table = "configs_hierarchies";

    protected $fillable = [
        'hierarchy_id',
        'league_id',
        'create_league_tournaments',
        'delete_league_tournaments',
        'edit_league_hierarchies',
        'edit_league_info',
        'edit_league_protests',
        'edit_league_tournaments',
        'view_menu'
    ];

    protected $hidden = [
        'id',
        'league_id',
        'hierarchy_id'
    ];

    use HasFactory;
}

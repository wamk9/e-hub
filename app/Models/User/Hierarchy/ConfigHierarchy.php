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
        'edit_league_info',
        'edit_league_hierarchies',
        'view_menu'
    ];

    protected $hidden = [
        'id',
        'league_id',
        'hierarchy_id'
    ];

    use HasFactory;
}

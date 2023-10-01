<?php

namespace App\Models\User;

use App\Models\User;
use App\Models\User\Hierarchy\ConfigHierarchy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hierarchy extends Model
{
    public $timestamps = false;

    protected $table = "hierarchies";

    protected $fillable = [
        'name',
        'description',
        'editable',
        'league_id'
    ];

    protected $hidden = [
        'id',
        'league_id'
    ];

    use HasFactory;

    /**
     * The Users that belong to the Hierarchy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_hierarchies', 'user_id');
    }

    public function config()
    {
        return $this->hasOne(ConfigHierarchy::class);
    }
}

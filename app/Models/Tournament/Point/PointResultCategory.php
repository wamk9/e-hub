<?php

namespace App\Models\Tournament\Point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointResultCategory extends Model
{
    public $timestamps = false;

    protected $table = 'point_result_categories';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'id'
    ];

    use HasFactory;

    /**
     * Get all of the results for the PointResultCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany(PointResult::class);
    }
}

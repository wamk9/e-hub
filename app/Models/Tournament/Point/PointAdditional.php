<?php

namespace App\Models\Tournament\Point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointAdditional extends Model
{
    public $timestamps = false;

    protected $table = 'point_additional';

    protected $fillable = [
        'point',
        'point_category_id',
        'point_protest_id',
        'point_result_id'
    ];

    protected $hidden = [
        'id',
        'point_category_id',
        'point_protest_id',
        'point_result_id'
    ];

    use HasFactory;

    /**
     * Get the category that owns the PointAdditional
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PointCategory::class, 'point_category_id');
    }
}

<?php

namespace App\Models\Tournament\Point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointReference extends Model
{
    public $timestamps = false;

    protected $table = 'point_references';

    protected $fillable = [
        'num_order',
        'point',
        'point_round_id'
    ];

    protected $hidden = [
        'id'
    ];

    use HasFactory;

    /**
     * Get the result that owns the PointReference
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function result(): BelongsTo
    {
        return $this->belongsTo(PointResult::class, 'point_reference_id');
    }
}

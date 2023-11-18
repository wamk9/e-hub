<?php

namespace App\Models\Tournament\Point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointRound extends Model
{
    public $timestamps = false;

    protected $table = 'point_rounds';

    protected $fillable = [
        'name',
        'point_event_id'
    ];

    protected $hidden = [
        'id',
        'point_event_id'
    ];

    use HasFactory;

    /**
     * Get the event that owns the PointRound
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(PointEvent::class);
    }

    /**
     * Get all of the references for the PointRound
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function references(): HasMany
    {
        return $this->hasMany(PointReference::class, 'point_round_id');
    }
}

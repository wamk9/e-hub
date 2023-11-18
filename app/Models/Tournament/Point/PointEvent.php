<?php

namespace App\Models\Tournament\Point;

use App\Models\Tournament\Tournament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointEvent extends Model
{
    protected $table = "point_events";

    protected $fillable = [
        'name',
        'description',
        'route',
        'init_at',
        'duration',
        'can_discard',
        'tournament_id'
    ];

    protected $hidden = [
        'tournament_id',
    ];


    use HasFactory;

    /**
     * Get the tournament that owns the PointEvent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * Get all of the rounds for the PointEvent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rounds(): HasMany
    {
        return $this->hasMany(PointRound::class);
    }
}

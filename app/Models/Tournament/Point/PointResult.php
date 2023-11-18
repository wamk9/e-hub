<?php

namespace App\Models\Tournament\Point;

use App\Models\Tournament\TournamentSubscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointResult extends Model
{
    public $timestamps = false;

    protected $table = 'point_result';

    protected $fillable = [
        'point_event_id',
        'point_standing_id',
        'point_reference_category_id',
        'tournament_subscription_id'
    ];

    protected $hidden = [
        'id',
        'point_event_id',
        'point_standing_id',
        'point_reference_category_id',
        'tournament_subscription_id'
    ];

    use HasFactory;

    /**
     * Get the category that owns the PointResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PointResultCategory::class, 'point_result_category_id');
    }

    /**
     * Get all of the pointAdditional for the PointResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pointAdditional(): HasMany
    {
        return $this->hasMany(PointAdditional::class, 'point_result_id');
    }

    /**
     * Get the tournamentSubscription that owns the PointResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournamentSubscription(): BelongsTo
    {
        return $this->belongsTo(TournamentSubscription::class, 'tournament_subscription_id');
    }

    /**
     * Get the event that owns the PointResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(User::class, 'point_event_id');
    }
}

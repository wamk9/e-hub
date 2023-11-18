<?php

namespace App\Models\Tournament\Point;

use App\Models\Tournament\TournamentSubscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PointProtest extends Model
{
    protected $table = 'point_protests';

    protected $fillable = [
        'subscription_to',
        'subscription_from',
        'description',
        'judgment',
        'point_events_id'
    ];

    protected $hidden = [
        'id',
        'point_events_id'
    ];

    use HasFactory;

    /**
     * Get the point associated with the PointProtest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function point(): HasOne
    {
        return $this->hasOne(PointAdditional::class);
    }

    /**
     * Get the event that owns the PointProtest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(PointEvent::class, 'point_event_id');
    }

    /**
     * Get the subscritpion that owns the PointProtest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriptionTo(): BelongsTo
    {
        return $this->belongsTo(TournamentSubscription::class, 'subscription_to');
    }

    /**
     * Get the subscritpion protested that the PointProtest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriptionFrom(): BelongsTo
    {
        return $this->belongsTo(TournamentSubscription::class, 'subscription_from');
    }
}

<?php

namespace App\Models\Tournament;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentSubscription extends Model
{
    public $timestamps = false;

    protected $table = 'tournaments_subscriptions';

    protected $fillable = [
        'member_id', 'team_id', 'payment_status_id'
    ];

    use SoftDeletes;
    use HasFactory;

    /**
     * Get the user that owns the TournamentSubscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class, 'member_id');
    }
}

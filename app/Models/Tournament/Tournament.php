<?php

namespace App\Models\Tournament;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\League\League;
use App\Models\Category\SubCategory;

class Tournament extends Model
{
    public $timestamps = false;

    protected $table = 'tournaments';

    protected $fillable = [
        'name',
        'description',
        'route',
        'price',
        'subscription_limit',
        'logo_image',
        'subcategory_id',
        'currency_id',
        'league_id'
    ];

    protected $hidden = [
        'subcategory_id',
        'league_id',
        'currency_id',
    ];

    use HasFactory;

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}

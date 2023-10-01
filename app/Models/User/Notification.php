<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const UPDATED_AT = null;

    protected $table = 'notifications';

    protected $hidden = [
        'user_id',
    ];

    protected $fillable = [
        'title', 'description', 'route'
    ];

    use HasFactory;
}

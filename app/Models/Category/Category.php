<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'route'
    ];

    use HasFactory;

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}

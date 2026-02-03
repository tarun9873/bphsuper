<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'url',
        'market_percentage',
        'min_percentage',
        'category',
        'position',
        'type'
    ];


    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category', 'name');
    }
}

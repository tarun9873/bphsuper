<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'site_count',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = \Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = \Str::slug($category->name);
        });
    }

    public function sites()
    {
        return $this->hasMany(Site::class, 'category', 'name');
    }
}
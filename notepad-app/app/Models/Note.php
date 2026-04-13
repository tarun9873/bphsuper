<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Note extends Model
{
    protected $fillable = ['share_id', 'title', 'content'];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($note) {
            if (empty($note->share_id)) {
                $note->share_id = Str::random(10);
            }
        });
    }
}
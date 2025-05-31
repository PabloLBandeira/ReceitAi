<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'occasion',
        'type',
        'skill',
        'people',
        'ingredients',
        'content',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

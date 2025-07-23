<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'type', 'breed', 'age', 'description'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
} 
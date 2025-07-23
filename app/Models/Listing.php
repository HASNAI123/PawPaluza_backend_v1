<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'sitter_id', 'title', 'description', 'price', 'service_type'
    ];

    public function sitter() { return $this->belongsTo(User::class, 'sitter_id'); }
} 
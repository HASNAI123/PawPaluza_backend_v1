<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'sitter_id', 'date', 'start_time', 'end_time'
    ];

    public function sitter() { return $this->belongsTo(User::class, 'sitter_id'); }
} 
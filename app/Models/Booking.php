<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'sitter_id', 'pet_id', 'start_date', 'end_date', 'status'
    ];

    public function owner() { return $this->belongsTo(User::class, 'user_id'); }
    public function sitter() { return $this->belongsTo(User::class, 'sitter_id'); }
    public function pet() { return $this->belongsTo(Pet::class); }
} 
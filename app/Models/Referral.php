<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $fillable = [
        'referred_to',
        'referred_by',
        'status',
        'updated_at'
        // Add other fields as needed
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assistance_request extends Model
{
    use HasFactory;
    protected $fillable = [
        'ownerId',
        'referral_status',
        'req_status',
        'referred_id'
        // Add other fields as needed
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class severity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        // Add other fields as needed
    ];

}

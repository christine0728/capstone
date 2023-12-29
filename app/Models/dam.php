<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dam extends Model
{
    use HasFactory;
    protected $fillable = ['spilling_level', 'date_and_time', 'current_level', 'opening_of_gate'];

}

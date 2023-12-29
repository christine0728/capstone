<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipientEvent extends Model
{
    use HasFactory;
    protected $fillable = ['eventId', 'recipientId'];
}

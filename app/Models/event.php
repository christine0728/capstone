<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;
    protected $fillable = [
     'title',        // Add 'title' to the fillable array
     'type_id',
     'recipientId',
     'randomId',
     'userid',
     'location',
     'start',
     'end',
     'start_time',
     'end_time',
     'description',
 ];
}

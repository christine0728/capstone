<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sitrep extends Model
{
    use HasFactory;
    public function dam()
    {
        return $this->belongsTo(Dam::class, 'damId');
    }
    public function Subject()
    {
        return $this->belongsTo(Dam::class, 'subjectId');
    }
    public function road_bridges()
    {
        return $this->belongsTo(road_bridges::class, 'roads_and_bridgesId');
    }
    protected $fillable = [
        'userId',
        'subjectId', // Add this line
        // Other fillable fields...
    ];
}

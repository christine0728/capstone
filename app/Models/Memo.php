<?php

namespace App\Models;
use App\Models\memo_municipality;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject', // Add other fields as needed
        'notes',
        'attachments',
        // Add other fields as needed
    ];
    public function memoMunicipalities()
    {
        return $this->hasMany(memo_municipality::class);
    }
}

<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memo_municipality extends Model
{
    use HasFactory;
    protected $fillable = [
        // other fillable attributes,
        'read_at',
    ];
    public function municipality()
    {
        return $this->belongsTo(User::class);
    }
    public function memo()
    {
        return $this->belongsTo(Memo::class, 'memo_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'municipality_id', 'id');
    }
}

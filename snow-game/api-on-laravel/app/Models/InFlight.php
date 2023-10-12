<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InFlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'speed', 'x', 'y',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

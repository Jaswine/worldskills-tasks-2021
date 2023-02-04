<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameFinish extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'result'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

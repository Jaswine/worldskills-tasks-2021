<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bounce extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'speed',
        'baseAngle',
        'lastAngle',
        'power',
        'time'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}

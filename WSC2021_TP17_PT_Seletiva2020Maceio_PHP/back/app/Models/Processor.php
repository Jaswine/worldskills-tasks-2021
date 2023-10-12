<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processor extends Model
{
    protected $fillable = [
        'name', 'imageUrl', 'brandId', 'socketTypeId', 'cores', 'baseFrequency',
        'maxFrequency', 'cacheMemory', 'tdp'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function socketType() {
        return $this->belongsTo(SocketType::class);
    }

    public function machine() {
        return $this->hasMany(Machine::class);
    }

    protected $table = 'processor';

    public $timestamps = false;
    
    use HasFactory;
}

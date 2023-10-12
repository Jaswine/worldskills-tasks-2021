<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motherboard extends Model
{
    protected $fillable = [
        'name', 'imageUrl', 
        'brandId', 
        'socketTypeId', 
        'ramMemoryTypeId',
        'ramMemorySlots',
        'maxTdp',
        'sataSlots',
        'm2Slots',
        'pciSlots'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function socketType() {
        return $this->belongsTo(SocketType::class);
    }

    public function ramMemoryType() {
        return $this->belongsTo(ramMemoryType::class);
    }

    public function machine() {
        return $this->hasMany(Machine::class);
    }

    protected $table = 'motherboard';
    public $timestamps = false;
    
    use HasFactory;
}

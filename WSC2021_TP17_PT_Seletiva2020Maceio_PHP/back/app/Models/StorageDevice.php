<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageDevice extends Model
{
    protected $fillable = [
        'name', 'imageUrl', 'brand_id', 'storageDeviceType', 'size', 'storageDeviceInterface'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function machine() {
        return $this->hasMany(Machine::class);
    }

    public function storageDevice() {
        return $this->belongsToMany(StorageDevice::class);
    }

    protected $table = 'storageDevice';

    public $timestamps = false;
    
    use HasFactory;
}

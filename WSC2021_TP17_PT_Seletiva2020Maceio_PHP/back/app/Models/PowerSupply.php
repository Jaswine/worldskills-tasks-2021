<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerSupply extends Model
{
    protected $fillable = [
        'name', 'imageUrl', 'brand_id', 'potency', 'badge80Plus'
    ];
    
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function machine() {
        return $this->hasMany(Machine::class);
    }

    protected $table = 'powerSupply';
    public $timestamps = false;
    
    use HasFactory;
}

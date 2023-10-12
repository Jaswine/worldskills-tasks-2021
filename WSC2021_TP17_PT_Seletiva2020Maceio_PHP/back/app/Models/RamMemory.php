<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamMemory extends Model
{
    protected $fillable = [
       'name', 'imageUrl', 'brand_id', 'size', 'ramMemoryType_id', 'frequency'
    ];

    public function ramMemoryType() {
        return $this -> belongsTo(RamMemoryType::class);
    }

    public function brand() {
        return $this -> belongsTo(brand::class);
    }

    public function machine() {
        return $this->hasMany(Machine::class);
    }
    
    protected $table = 'ramMemory';

    public $timestamps = false;
    
    use HasFactory;
}

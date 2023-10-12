<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamMemoryType extends Model
{
    protected $fillable = [
        'name'
     ];

    public function motherboard() {
        return $this -> belongsTo(Motherboard::class);
    }

    public function ramMemory() {
        return $this -> belongsTo(RamMemory::class);
    }

    protected $table = 'ramMemoryType';
    
    public $timestamps = false;
    
    use HasFactory;
}

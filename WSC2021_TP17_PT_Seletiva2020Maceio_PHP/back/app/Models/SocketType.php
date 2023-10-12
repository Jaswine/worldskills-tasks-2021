<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocketType extends Model
{

    protected $fillable = [
        'name'
    ];

    public function motherboards() {
        return $this ->hasMany(Motherboard::class);
    }

    public function processors() {
        return $this ->hasMany(Processor::class);
    }

    protected $table ='socketType';

    public $timestamps = false;

    use HasFactory;
}

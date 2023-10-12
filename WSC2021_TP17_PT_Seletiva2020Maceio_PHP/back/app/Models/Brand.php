<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function motherboards() {
        return $this ->hasMany(Motherboard::class);
    }

    public function processors() {
        return $this ->hasMany(Processor::class);
    }

    public function ramMemory() {
        return $this ->hasMany(RamMemory::class);
    }

    public function storageDevice() {
        return $this ->hasMany(StorageDevice::class);
    }

    public function graphicCard() {
        return $this ->hasMany(GraphicCard::class);
    }

    public function PowerSupplyc() {
        return $this ->hasMany(PowerSupply::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brand';

    use HasFactory;
}

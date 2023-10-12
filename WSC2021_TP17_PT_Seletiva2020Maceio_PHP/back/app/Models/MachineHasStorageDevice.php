<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineHasStorageDevice extends Model
{

    protected $fillable = [
        'machine_id', 'storageDevice_id', 'amount'
    ];

    public function machine() {
        return $this->belongsTo(Machine::class);
    }
    public function storageDevice() {
        return $this->belongsTo(StorageDevice::class);
    }
    public $timestamps = false;

    protected $table = 'machineHasStorageDevice';

    use HasFactory;
}

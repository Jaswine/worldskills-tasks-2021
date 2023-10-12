<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraphicCard extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'imageUrl',
        'brand_id',
        'memorySize',
        'memoryType',
        'minimumPowerSupply',
        'supportMultiGpu',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function machine() {
        return $this->hasMany(Machine::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'graphicCard';

    use HasFactory;
}

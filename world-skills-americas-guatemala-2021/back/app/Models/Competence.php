<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'competence',
        'height',
        'job_id'
    ];

    public function job() {
        return $this->belongsTo(Job::class);
    }
    public $timestamps = false;

}

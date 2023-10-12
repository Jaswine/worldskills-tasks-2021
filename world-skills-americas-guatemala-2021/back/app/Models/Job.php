<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job',
    ];

    public function competentions() {
        return $this->hasMany(Competence::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }

    public $timestamps = false;

}

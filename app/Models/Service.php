<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * Kolone koje je dozvoljeno masovno popunjavati.
     */
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'duration'
    ];
}
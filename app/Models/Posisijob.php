<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisijob extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'status'
    ];

}

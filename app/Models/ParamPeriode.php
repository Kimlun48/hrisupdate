<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamPeriode extends Model
{
    use HasFactory;
    protected $fillable = [
        'startdate',
        'enddate',
        'status',
	];
}

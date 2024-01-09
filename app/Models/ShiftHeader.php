<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftHeader extends Model
{
	use HasFactory;
	protected $fillable = [
        'hari',
        'keterangan',
        'user_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogCrontab extends Model
{
	use HasFactory;
    	protected $fillable = [
            'nama_menu','tanggal','keterangan','created_at'
    ];
}

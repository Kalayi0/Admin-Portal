<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    use HasFactory;

    protected $fillable = ['service_name', 'status', 'response_time_ms', 'checked_at'];

    protected $casts = [
        'checked_at' => 'datetime',
    ];
}
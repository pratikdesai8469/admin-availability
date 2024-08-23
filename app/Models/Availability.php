<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'category_id',
        'start_time',
        'end_time',
        'interval',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];
}

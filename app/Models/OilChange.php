<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilChange extends Model
{
    use HasFactory;

    protected $fillable = ['current_odometer', 'previous_date', 'previous_odometer'];

    protected $casts = [
        'previous_date' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "date_start",
        "date_end",
        "status",
        "budget",
        "comments",
    ];

    protected $casts = [
        "comments" => "json",
        "date_time" => "datetime",
        "date_end" => "datetime",
    ];
}

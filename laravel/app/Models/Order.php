<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \MoonShine\Fields\RelationShips\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "date_start",
        "date_start",
        "status",
        "budget",
        "comments",
    ];

    protected $casts = [
        "comments" => "json",
        "date_time" => "datetime",
        "date_end" => "datetime",
    ];

    public function categories(){
        return $this->belongsToMany(OrderCategory::class, "order_order_categories");
    }
}

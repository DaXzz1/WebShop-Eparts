<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "order_products";

    protected $fillable = ["orderId", "partId", "quantity"];

    public function order()
    {
        return $this->belongsTo(Order::class, "orderId");
    }

    public function part()
    {
        return $this->belongsTo(Part::class, "partId");
    }
}

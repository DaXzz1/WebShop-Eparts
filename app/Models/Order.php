<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "orders";

    protected $fillable = ["userId", "amount", "session", "status", "boughtAt"];

    public function user()
    {
        return $this->belongsTo(User::class, "userId");
    }

    public function parts()
    {
        return $this->hasMany(OrderProduct::class, "orderId");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "cars";

    protected $fillable = ["name", "slug", "image"];

    public function models()
    {
        return $this->hasMany(CarModel::class, "carId");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "car_models";

    protected $fillable = [
        "carId",
        "name",
        "slug",
        "image",
        "releasedAt",
        "stoppedAt",
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, "carId");
    }

    public function categories()
    {
        return $this->hasMany(PartCategory::class, "modelId");
    }

    public function category()
    {
        return $this->hasOne(PartCategory::class, "modelId");
    }

    public function modifications() {
        return $this->hasMany(ModelModification::class, "modelId");
    }

    public function modification() {
        return $this->hasOne(ModelModification::class, "modelId");
    }
}

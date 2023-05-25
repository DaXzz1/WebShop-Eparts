<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "parts";

    protected $fillable = [
        "categoryId",
        "etName",
        "enName",
        "ruName",
        "image",
        "manufacturer",
        "price",
        "quantity",
        "code",
        "color",
        "location",
        "width",
        "height",
        "length",
        "material",
    ];

    public function category()
    {
        return $this->belongsTo(PartCategory::class, "categoryId");
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, "modelId");
    }

    public function orders()
    {
        return $this->hasMany(OrderProduct::class, "productId");
    }

    public function modification()
    {
        return $this->belongsTo(ModelModification::class, "modificationId");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "part_categories";

    protected $fillable = [
        "categoryId",
        "modelId",
        "modificationId",
        "etName",
        "enName",
        "ruName",
        "slug",
        "image",
    ];

    public function model() {
        return $this->belongsTo(CarModel::class, "modelId");
    }

    public function car()
    {
        return $this->belongsTo(Car::class, "modelId");
    }

    public function parts()
    {
        return $this->hasMany(Part::class, "categoryId");
    }

    public function category() {
        return $this->belongsTo(Category::class, "categoryId");
    }

    public function modifications()
    {
        return $this->hasMany(ModelModification::class, "id");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ["enName", "etName", "ruName"];

    public function partCategories() {
        return $this->hasMany(PartCategory::class, "categoryId", "id");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "bodies";

    protected $fillable = [
        "enName",
        "etName",
        "ruName",
        "slug",
    ];
}

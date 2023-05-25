<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelModification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "model_modifications";

    protected $fillable = [
        "modelId",
        "bodyId",
        "engineCode",
        "engineCapacity",
        "enginePower",
        "engineTorque",
        "engineFuel",
        "engineFuelConsumptionCity",
        "engineFuelConsumptionHighway",
        "engineFuelConsumptionCombined",
        "engineInjectionType",
        "engineCylinderCount",
        "engineValveCount",
        "transmissionType",
        "transmissionGearCount",
        "transmissionDrive",
        "weight",
        "clearance",
        "fuelTankCapacity",
        "trunkCapacity",
        "seatsCount",
        "doorsCount",
        "releasedAt",
        "stoppedAt",
    ];

    public function getCapacityFloat()
    {
        return number_format($this->engineCapacity / 1000, 1, '.', '');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, "modelId");
    }

    public function categories()
    {
        return $this->hasMany(PartCategory::class, "modificationId");
    }

    public function parts()
    {
        return $this->hasMany(Part::class, "modificationId");
    }

    public function category()
    {
        return $this->hasOne(PartCategory::class, "modificationId");
    }

    public function part()
    {
        return $this->hasOne(Part::class, "modificationId");
    }

    public function body()
    {
        return $this->belongsTo(BodyType::class, "bodyId");
    }
}

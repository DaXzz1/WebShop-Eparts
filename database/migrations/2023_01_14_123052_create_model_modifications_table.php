<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_modifications', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId("modelId")->constrained("car_models")->cascadeOnDelete();
            $table->foreignId("bodyId")->constrained("bodies")->cascadeOnDelete();
            $table->string("engineCode")->comment("Engine code");
            $table->integer("engineCapacity")->comment("Engine capacity (cc)");
            $table->integer("enginePower")->nullable()->comment("Engine power (hp)");
            $table->integer("engineTorque")->nullable()->comment("Engine torque (Nm)");
            $table->enum("engineFuel", ["petrol", "diesel", "hybrid", "electric", "gas"])->comment("Engine fuel type");
            $table->float("engineFuelConsumptionCity")->nullable()->comment("Engine fuel consumption in city (l/100km)");
            $table->float("engineFuelConsumptionHighway")->nullable()->comment("Engine fuel consumption on highway (l/100km)");
            $table->float("engineFuelConsumptionCombined")->nullable()->comment("Engine fuel consumption combined (l/100km)");
            $table->string("engineInjectionType")->nullable()->comment("Engine injection type (TDI, TFSI, etc.)");
            $table->integer("engineCylinderCount")->nullable()->comment("Engine cylinder count");
            $table->integer("engineValveCount")->nullable()->comment("Engine valve count");
            $table->enum("transmissionType", ["automatic", "manual", "robotic", "variator"])->comment("Transmission type");
            $table->integer("transmissionGearCount")->nullable()->comment("Transmission gear count");
            $table->enum("transmissionDrive", ["front", "rear", "full"])->comment("Transmission drive");
            $table->float("weight")->nullable()->comment("Weight (kg)");
            $table->float("clearance")->nullable()->comment("Clearance (mm)");
            $table->integer("fuelTankCapacity")->nullable()->comment("Fuel tank capacity (l)");
            $table->integer("trunkCapacity")->nullable()->comment("Trunk capacity (l)");
            $table->integer("seatsCount")->nullable()->comment("Seats count");
            $table->integer("doorsCount")->nullable()->comment("Doors count");
            $table->string("releasedAt")->comment("Released at");
            $table->string("stoppedAt")->nullable()->comment("Stopped at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_modifications');
    }
};

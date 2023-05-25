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
        Schema::create("parts", function (Blueprint $table) {
            $table->id();
            $table->foreignId("modificationId")->nullable()->constrained("model_modifications")->cascadeOnDelete();
            $table
                ->foreignId("categoryId")
                ->constrained("part_categories")
                ->cascadeOnDelete();
            $table->string("etName");
            $table->string("enName");
            $table->string("ruName");
            $table->text("image");
            $table->string("manufacturer");
            $table->integer("price");
            $table->integer("quantity");
            $table->string("code")->nullable();
            $table->enum('color', [
                "black",
                "white",
                "silver",
                "gray",
                "red",
                "blue",
                "green",
                "yellow",
                "brown",
                "orange",
                "purple",
                "pink",
                "gold",
                "beige",
                "other",
                "unknown"
            ])->nullable();
            $table
                ->enum("location", [
                    "front",
                    "back",
                    "left",
                    "right",
                    "top",
                    "bottom",
                    "both",
                ])
                ->nullable();
            $table->float("width")->nullable();
            $table->float("height")->nullable();
            $table->float("length")->nullable();
            $table->enum("material", [
                'steel',
                'aluminium',
                'plastic',
                'glass',
            ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("parts");
    }
};

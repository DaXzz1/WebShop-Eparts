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
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("userId")
                ->nullable()
                ->constrained("users")
                ->cascadeOnDelete();
            $table->boolean("isIgnoring")->default(false);
            $table->integer("amount");
            $table->string("session");
            $table->string("status")->default("unpaid");
            $table->dateTime("boughtAt")->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("orders");
    }
};

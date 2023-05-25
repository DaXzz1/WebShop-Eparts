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
        Schema::create("order_products", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("orderId")
                ->constrained("orders")
                ->cascadeOnDelete();
            $table
                ->foreignId("partId")
                ->constrained("parts")
                ->cascadeOnDelete();
            $table->integer("quantity");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("order_products");
    }
};

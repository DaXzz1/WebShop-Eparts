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
        Schema::create("users", function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("name")->unique();
            $table->string("email")->unique();
            $table->string("password");
            $table->string("firstName")->nullable();
            $table->string("lastName")->nullable();
            $table->string("phone")->nullable();
            $table->string("country")->nullable();
            $table->string("city")->nullable();
            $table->string("address")->nullable();
            $table->string("address2")->nullable();
            $table->string("zipCode")->nullable();
            $table->string("state")->nullable();
            $table->string("avatar")->default("default.png");
            $table->enum("role", ["user", "manager", "admin"]);
            $table->rememberToken();
            $table->string("stripe_id")->nullable();
            $table->timestamp("createdAt")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users");
    }
};

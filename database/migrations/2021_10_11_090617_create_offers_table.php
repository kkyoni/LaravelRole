<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->enum('discount_type',['percentage','absolute'])->nullable();
            $table->enum('offer_type',['discount','bonus'])->nullable();
            $table->enum('offer_coupon_type',['offer','agent'])->nullable();
            $table->string('offer_for_users')->nullable();
            $table->string('auto_recharge')->nullable();
            $table->string('product')->nullable();
            $table->string('amount')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('offer_image')->nullable();
            $table->enum('status',['active','inactive'])->nullable();
            $table->string('coupon_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}

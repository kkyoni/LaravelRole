<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffertemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offertemplate', function (Blueprint $table) {
            $table->id();
            $table->string('template_name')->nullable();
            $table->string('product')->nullable();
            $table->dateTime('recharge_date')->nullable();
            $table->dateTime('end_date')->nullable();
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
        Schema::dropIfExists('offertemplate');
    }
}

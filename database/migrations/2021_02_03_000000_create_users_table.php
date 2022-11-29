<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->length(255)->nullable();
            $table->string('first_name')->length(255)->nullable();
            $table->string('last_name')->length(255)->nullable();
            $table->string('email')->length(255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->length(255)->nullable();
            $table->string('user_type')->length(255)->nullable();
            $table->string('department')->length(255)->nullable();
            $table->string('role_id')->length(255)->nullable();
            $table->enum('status',['active','block'])->default('active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

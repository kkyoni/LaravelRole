<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqquestionanswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqquestionanswer', function (Blueprint $table) {
            $table->id();
            $table->string('faq_id')->nullable();
            $table->longText('question')->nullable();
            $table->longText('answer')->nullable();
            $table->enum('status',['active','inactive'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqquestionanswer');
    }
}

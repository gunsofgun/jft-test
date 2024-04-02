<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answer_details', function (Blueprint $table) {
            $table->id();
            $table->string('answer_char')->nullable();
            $table->string('question_test_id')->nullable();
            $table->string('section_id')->nullable();
            $table->foreignId('user_answer_id')->constrained('user_answers');
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
        Schema::dropIfExists('user_answer_details');
    }
};

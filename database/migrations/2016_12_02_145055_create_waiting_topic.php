<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaitingTopic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('waiting_topic', function (Blueprint $table) {
            $table->string('student_id');
            $table->primary('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            // $table->foreign('student_id')->references('id')->on('students');
            
            $table->string('new_name');
            $table->string('new_teacher');
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
        Schema::dropIfExists('waiting_topic');
    }
}

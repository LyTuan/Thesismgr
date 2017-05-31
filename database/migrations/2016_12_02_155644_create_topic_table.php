<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('student_id');
            $table->integer('instructor_accept')->default(0);//0 is not accept and 1 is accept
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            // $table->foreign('student_id')->references('id')->on('students');
            $table->string('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
            // $table->foreign('instructor_id')->references('id')->on('instructors');
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
        Schema::dropIfExists('topic');
    }
}

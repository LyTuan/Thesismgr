<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->string('name');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('year')->on('courses')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('status')->default('0');//2 value 0 or 1. 1 is enough
            $table->integer('status_register')->default('0');
            // 0 is not register
            // 1 is registered.
            // 2 is cancel register.
            // 3 is update register.
            // 4 is updated
            // 5 is recorded
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
        Schema::dropIfExists('students');
    }
}

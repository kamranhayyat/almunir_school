<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->integer('com_no');
            $table->string('reg_no');
            $table->string('student_name');
            $table->string('father_name');
            $table->string('gender');
            $table->date('dob');
            $table->string('class');
            $table->string('section');
            $table->string('class_section');
            $table->string('father_cnic');
            $table->string('father_mobile');
            $table->string('mother_mobile');
            $table->string('password');
            $table->string('status');
            $table->string('image');
            $table->string('results');
            $table->string('invoices');
            $table->string('attendance');
            $table->string('date_sheet');
            $table->string('complaints');
            $table->string('islamic_dua');
            $table->string('notice_board');
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

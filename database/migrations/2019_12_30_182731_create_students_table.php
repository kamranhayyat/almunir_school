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
            $table->date('admission_date');
            $table->string('roll_no');
            $table->date('dob');
            $table->string('student_name');
            $table->string('father_name');
            $table->string('class');
            $table->string('section');
            $table->string('father_mobile');
            $table->string('mother_mobile');
            $table->string('father_cnic');
            $table->string('user_id');
            $table->string('password');
            $table->string('image');
            $table->string('result');
            $table->string('invoice');
            $table->string('daily_test');
            $table->string('diary');
            $table->string('complain');
            $table->string('learner_hw');
            $table->string('attendance');
            $table->string('fee_blnc');
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

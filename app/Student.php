<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'admission_date', 
        'roll_no', 
        'dob',
        'student_name',
        'father_name',
        'class',
        'section',
        'father_mobile',
        'mother_mobile',
        'father_cnic',
        'user_id',
        'password',
        'image',
        'result',
        'invoice',
        'daily_test',
        'diary',
        'complain',
        'learner_hw',
        'attendance',
        'fee_blnc'];
}

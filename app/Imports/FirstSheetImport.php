<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Student::create([
                'admission_date' =>  date("Y-m-d", strtotime(str_replace("/","-",$row['admissiondate']))),
                'roll_no' => $row['rollno'],
                'dob' => date("Y-m-d", strtotime(str_replace("/","-",$row['dob']))),
                'student_name' => $row['studentname'],
                'father_name' => $row['fathername'],
                'class' => $row['class'],
                'section' => $row['section'],
                'father_mobile' => $row['fathermobile'],
                'mother_mobile' => $row['mothermobile'],
                'father_cnic' => $row['fathercnic'],
                'user_id' => $row['userid'],
                'password' => $row['password'],
                'image' => $row['image'],
                'result' => $row['result'],
                'invoice' => $row['invoice'],
                'daily_test' => $row['dailytest'],
                'diary' => $row['diary'],
                'complain' => $row['complain'],
                'learner_hw' => $row['learner_hw'],
                'attendance' => $row['attendance'],
                'fee_blnc' => $row['fee_blnc'],
            ]);

            User::create([
                'name' => $row['studentname'],
                'user_id' => $row['userid'],
                'password' => $row['password'],
                'user_type' => '2',
            ]);
            
        }
    }

}
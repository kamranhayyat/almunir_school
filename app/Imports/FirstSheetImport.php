<?php
namespace App\Imports;

use App\Student;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Validator;

class FirstSheetImport implements ToCollection, WithHeadingRow, WithBatchInserts
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $this->validationFields($row);      
            Student::create([
                'com_no' =>  $row['com'],
                'reg_no' => $row['reg'],
                'student_name' => $row['student_name'],
                'father_name' => $row['father_name'],
                'gender' => $row['gender'],
                'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']),
                'class' => $row['class'],
                'section' => $row['section'],
                'class_section' => $row['class']. ' ' .$row['section'],
                'father_cnic' => $row['father_cnic'],
                'father_mobile' => $row['father_mobile'],
                'status' => $row['status'],
                'results' => $row['results'],
                'invoices' => $row['invoices'],
                'attendance' => $row['attendance'],
                'date_sheet' => $row['date_sheet'],
                'complaints' => $row['complaints'],
                'islamic_dua' => $row['islamic_duas'],
                'notice_board' => $row['notice_board'],
            ]);

            User::create([
                'username' => $row['father_cnic'],
                'password' => bcrypt($row['father_mobile']),
                'user_type' => '2',
            ]);
            
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function validationFields($row)
    {
        Validator::make($row->toArray(), [
                'com' =>  'required',
                'reg' => 'required',
                'student_name' => 'required',
                'father_name' => 'required',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'class' => 'required',
                'section' => 'required',
                'father_cnic' => 'required',
                'father_mobile' => 'required',
                'status' => 'required',
                'results' => 'required',
                'invoices' => 'required',
                'attendance' => 'required',
                'date_sheet' => 'required',
                'complaints' => 'required',
                'islamic_duas' => 'required',
                'notice_board' => 'required',
        ])->validate();
    }

}
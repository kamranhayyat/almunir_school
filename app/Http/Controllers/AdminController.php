<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Excel;

class AdminController extends Controller
{
    public function show_std(){
        $students = Student::paginate(20);
        return view('students.show_std', compact('students'));
    }

    public function import_std(){
        return view('students.import_std');
    }

    public function import(Request $request){
        
        $attributes = $this->validate($request, [
            'student_excel'  => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new UsersImport, request()->file('student_excel'));
        } catch (\Exception $e) {
            return back()->with('unsuccessful', 'Excel Data Couldnt Be Imported.');
        }

        return back()->with('success', 'Excel Data Imported successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Student;
use App\Lesson;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Excel;
use DB;

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

    public function show_std_lesson(){
        $lessons = Lesson::paginate(20);
        return view('students.std_lesson', compact('lessons'));
    }

    public function upload_std_lesson(){
        $students = Student::distinct()->get(['class' , 'section']);
        return view('students.upload_std_lesson' , compact('students'));
    }

    public function upload_std_lesson_pdf(Request $request){

        $attributes = $this->validate($request, [
            'lesson_name'  => 'required',
            'lesson_description'  => 'required',
            'class'  => 'required',
            'section'  => 'required',
            'student_lesson'  => 'required|mimes:pdf'
        ]);

        $uniqueFileName = $attributes['class'] .  '_' . $attributes['section'] . '.' .
        $request->file('student_lesson')->getClientOriginalExtension();

        $request->file('student_lesson')->move(public_path('files') , $uniqueFileName);

        Lesson::create([
            'lesson_name' => $attributes['lesson_name'],
            'lesson_description' => $attributes['lesson_description'],
            'class' => $attributes['class'],
            'section' => $attributes['section'],
            'lesson_pdf' => str_replace(" ", "_", $uniqueFileName),
        ]);

        return redirect('/students/lesson-plan')->with('success', 'File uploaded successfully.');
        
    }

    public function getDownload($pdf_name)
    {
        $file= public_path(). "/files/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function delete_pdf($pdf_name, $id) {
        
        if(file_exists(public_path(). "/files/" . base64_decode($pdf_name))){

            unlink(public_path(). "/files/" . base64_decode($pdf_name));

            Lesson::findOrFail(base64_decode($id))->delete();

            return redirect()->back()->with('success-delete', 'File deleted successfully'); 

        } else {

            return redirect()->back()->with('unsuccess-delete', 'File not found'); 

        }

    }
}

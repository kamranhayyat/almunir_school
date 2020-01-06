<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Student;
use App\Lesson;
use App\Material;
use App\Event as EventModel;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Excel;
use DB;
use MaddHatter\LaravelFullcalendar\Event;

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

    public function show_std_material(){
        $materials = Material::paginate(20);
        return view('students.std_material', compact('materials'));
    }

    public function study_material_upload(){
        $students = Student::distinct()->get(['class' , 'section']);
        return view('students.upload_std_material' , compact('students'));
    }

    public function upload_std_material_pdf(Request $request){
        // dd($request->all());
        $attributes = $this->validate($request, [
            'material_name'  => 'required',
            'material_description'  => 'required',
            'class'  => 'required',
            'section'  => 'required',
            'student_material'  => 'required|mimes:pdf'
        ]);

        $uniqueFileName = $attributes['class'] .  '_' . $attributes['section'] . '.' .
        $request->file('student_material')->getClientOriginalExtension();

        $request->file('student_material')->move(public_path('files') , $uniqueFileName);

        Material::create([
            'material_name' => $attributes['material_name'],
            'material_description' => $attributes['material_description'],
            'class' => $attributes['class'],
            'section' => $attributes['section'],
            'material_pdf' => str_replace(" ", "_", $uniqueFileName),
        ]);

        return redirect('/students/study-material')->with('success', 'File uploaded successfully.');
        
    }

    public function get_download_material($pdf_name)
    {
        $file= public_path(). "/files/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function delete_pdf_material($pdf_name, $id) {
        
        if(file_exists(public_path(). "/files/" . base64_decode($pdf_name))){

            unlink(public_path(). "/files/" . base64_decode($pdf_name));

            Material::findOrFail(base64_decode($id))->delete();

            return redirect()->back()->with('success-delete', 'File deleted successfully'); 

        } else {

            return redirect()->back()->with('unsuccess-delete', 'File not found'); 

        }
    }

    public function events(){

        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return view('hello');

        // $events = EventModel::all();
        // $event = [];
        // foreach($events as $row){
        //     $end_date = $row->end_date . "24:00:00";
        //     $event = \Calendar::event(
        //         $row->title,
        //         true,
        //         new \DateTime($row->start_date),
        //         new \DateTime($row->end_date),
        //         $row->id,
        //         ['color' => $row->color]
        //     );
        // }
        // $calendar = \Calendar::addEvents($event);

        // return view('hello', compact('events', 'calendar'));
    }
    public function create(Request $request)
    {  
        return view('events.create');
    }

    public function show_events()
    {  
        $events = EventModel::all();
        return view('calendar', compact('events'));
    }

    public function store(Request $request){
        // dd($request->all());
        EventModel::create($request->all());
        return redirect()->route('show-events');
    }
}

<?php

namespace App\Http\Controllers;

use App\Student;
use App\Lesson;
use App\Material;
use App\Event;
use App\Namaz;
use App\Notification;
use App\Noticeboard;
use App\Complaint;
use App\Dua;
use App\Datesheet;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
// use Illuminate\Pagination\LengthAwarePaginator;
use Excel;
use DB;

class AdminController extends Controller
{
    public function __construct(){
        ini_set('max_execution_time', 180);
    }

    public function unauthorized_action(){
        if(auth()->user()->user_type != 1){
            abort(403, 'Unauthorized action.');
        }
    }

    public function index(){
        $namazs = Namaz::all();
        $notifications = Notification::all();
        return view('dashboard', compact('namazs', 'notifications'));
    }

    public function searchStudents(Request $request){

        $classes = Student::select('class')->groupBy('class')->get()->toArray();
        $sections = Student::select('section')->groupBy('section')->get()->toArray();

        $students = "";
        
        if($request->section == "" && $request->class == "" && $request->gender == "" && $request->wildcard == ""){
            $students = Student::paginate(20);
        }
        else if($request->section == "" && $request->class == "" && $request->gender == ""){
            $students = Student::
            orWhere('com_no','LIKE','%'.$request->wildcard.'%')
            ->orWhere('reg_no','LIKE','%'.$request->wildcard.'%')
            ->orWhere('student_name','LIKE','%'.$request->wildcard.'%')
            ->orWhere('father_name','LIKE','%'.$request->wildcard.'%')
            ->orWhere('dob','LIKE','%'.$request->wildcard.'%')
            ->orWhere('father_cnic','LIKE','%'.$request->wildcard.'%')
            ->orWhere('father_mobile','LIKE','%'.$request->wildcard.'%')
            ->paginate(20);
            // dd( $students );
        }
        else if($request->gender == "" && $request->class == ""){
            if($request->wildcard == ""){
                $students = Student::where('section', $request->section)->paginate(20);
                // dd( $students );
            }
            else {
                $students = Student::where('section', $request->section)
                ->orWhere('com_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('reg_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('student_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('dob','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_cnic','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_mobile','LIKE','%'.$request->wildcard.'%')
                ->paginate(20);
            }
            // dd( $students );
        }
        else if($request->gender == "" && $request->section == ""){
            if($request->wildcard == ""){
                $students = Student::where('class', $request->class)->paginate(20);
                // dd( $students );
            }
            else{
                $students = Student::where('class', $request->class)
                ->orWhere('com_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('reg_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('student_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('dob','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_cnic','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_mobile','LIKE','%'.$request->wildcard.'%')
                ->paginate(20);
            }
            // dd( $students );
        }
        else if($request->section == "" && $request->class == ""){
            if($request->wildcard == ""){
                $students = Student::where('gender', $request->gender)->paginate(20);
                // dd( $students );
            }
            else{
                $students = Student::where('gender', $request->gender)
                ->orWhere('com_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('reg_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('student_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('dob','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_cnic','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_mobile','LIKE','%'.$request->wildcard.'%')
                ->paginate(20);
            }
            // dd( $students );
        }
        else if( $request->gender == "" ){
            if($request->wildcard == "") {
                $students = Student::where('class', $request->class)
                ->where('section', $request->section)->paginate(20);
                // dd( $students );
            }
            else {
                $students = Student::where('class', $request->class)->where('section', $request->section)
                ->orWhere('com_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('reg_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('student_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('dob','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_cnic','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_mobile','LIKE','%'.$request->wildcard.'%')
                ->paginate(20);
            }
            // dd( $students );
        }
        else if($request->class == "") {
            if($request->wildcard == ""){
                $students = Student::where('gender', $request->gender)->where('section', $request->section)
                ->paginate(20);
                // dd( $students );
            }
            else{
                $students = Student::where('gender', $request->gender)->where('section', $request->section)
                ->orWhere('com_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('reg_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('student_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('dob','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_cnic','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_mobile','LIKE','%'.$request->wildcard.'%')
                ->paginate(20);
            }
            // dd( $students );
        }
        else if($request->section == ""){
            if($request->wildcard == ""){
                $students = Student::where('gender', $request->gender)->where('class', $request->class)
                ->paginate(20);
                // dd( $students );
            }
            else{
                $students = Student::where('gender', $request->gender)->where('class', $request->class)
                ->orWhere('com_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('reg_no','LIKE','%'.$request->wildcard.'%')
                ->orWhere('student_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_name','LIKE','%'.$request->wildcard.'%')
                ->orWhere('dob','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_cnic','LIKE','%'.$request->wildcard.'%')
                ->orWhere('father_mobile','LIKE','%'.$request->wildcard.'%')
                ->paginate(20);
            }
            // dd( $students );
        }
        else{
            // dd($request->all());
            $students = Student::
            where('gender', $request->gender)
            ->where('section', $request->section)
            ->where('class', $request->class)
            ->paginate(20)
            ;
        }

        return view('students.show_std', compact('students', 'classes',
         'sections', 'request'));
    }
    
    public function show_std(Request $request){
        $this->unauthorized_action();
        $students = Student::paginate(20);
        $classes = Student::select('class')->groupBy('class')->get()->toArray();
        $sections = Student::select('section')->groupBy('section')->get()->toArray();
        return view('students.show_std', compact('students', 'classes',
         'sections', 'request'));
    }

    public function import_std(){
        $this->unauthorized_action();
        return view('students.import_std');
    }

    public function import(Request $request){
        $this->unauthorized_action();
        $attributes = $this->validate($request, [
            'student_excel'  => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new StudentsImport, request()->file('student_excel'));
        } catch (\ValidationException $e) {
            return back()->with('unsuccessful', $e->errors());
        }

        return back()->with('success', 'Excel Data Imported successfully.');
    }

    public function show_pdf($pdf_name){

        $file= public_path(). "/files/" . base64_decode($pdf_name);

        return response()->file($file);
    }

    public function store_notification(Request $request){
        dd($request->all());
    }

    public function show_pdf_path($pdf_name){

        $arr = explode(" ", $pdf_name);
        // dd($arr[0]);
        $file= public_path(). "/uploads/$arr[0]/" . base64_decode($arr[1]);

        return response()->file($file);
    }

    public function delete_std($id){
        $this->unauthorized_action();
        Student::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success-delete', 'Record deleted successfully'); 
        
    }

    public function toggle_std($id){
        $this->unauthorized_action();
        $student = Student::findOrFail(base64_decode($id));
        if($student['status'] == 1){
            $student->status = 0;
            $student->save();
        } else {
            $student->status = 1;
            $student->save();
        }
        return redirect()->back();

    }

    public function show_individual_std($id){
        // $this->unauthorized_action();
        $student = Student::findOrFail(base64_decode($id));
        $only_class = explode(" ", $student['class_section']);
        $lessons = Lesson::where('class_section', '=', $student['class_section'])
        ->orWhere('class_section', '=', $only_class[0])
        ->get();
        return view('students.show_individual_std', compact('lessons', 'student'));
    }

    public function edit_std(Request $request, $id){
        $this->unauthorized_action();
        $student = Student::findOrFail(base64_decode($id));
        
        $student->com_no = request('com_no');
        $student->reg_no = request('reg_no');
        $student->student_name = request('student_name');
        $student->father_name = request('father_name');
        $student->gender = request('gender');
        $student->dob = request('dob');
        $student->class = request('class');
        $student->section = request('section');
        $student->father_cnic = request('father_cnic');
        $student->father_mobile = request('father_mobile');
        $student->mother_mobile = request('mother_mobile');

        $student->save();

        return redirect('/students')->with('success-update', 'Record updated successfully'); 

    }

    public function show_std_lesson(){
        $this->unauthorized_action();
        $lessons = Lesson::paginate(20);
        return view('students.std_lesson', compact('lessons'));
    }

    public function upload_std_lesson(){
        $this->unauthorized_action();
        $classes = Student::select('class')->groupBy('class')->get()->toArray();
        $sections = Student::select('section')->groupBy('section')->get()->toArray();
        return view('students.upload_std_lesson' , compact('classes', 'sections'));
    }

    public function upload_std_lesson_pdf(Request $request){
        $this->unauthorized_action();
        // dd($request->section);
        $attributes = $this->validate($request, [
            'lesson_name'  => 'required',
            'lesson_description'  => 'required',
            'class'  => 'required',
            'student_lesson'  => 'required|mimes:pdf'
        ]);

        if($request->section == 'Please Select Section') {
            $uniqueFileName = $attributes['class'] .  '.' .
            $request->file('student_lesson')->getClientOriginalExtension();
        } else {
            $uniqueFileName = $attributes['class'] .  '_' . $request->section . '.' .
            $request->file('student_lesson')->getClientOriginalExtension();
        }

        $request->file('student_lesson')->move(public_path('files') , $uniqueFileName);

        if($request->section == 'Please Select Section') {
            Lesson::create([
                'lesson_name' => $attributes['lesson_name'],
                'lesson_description' => $attributes['lesson_description'],
                'class_section' => $attributes['class'],
                'lesson_pdf' => str_replace(" ", "_", $uniqueFileName),
                'flag' => 1,
            ]);
        } else {
            Lesson::create([
                'lesson_name' => $attributes['lesson_name'],
                'lesson_description' => $attributes['lesson_description'],
                'class_section' => $attributes['class'] . ' ' . $request->section,
                'lesson_pdf' => str_replace(" ", "_", $uniqueFileName),
                'flag' => 0,
            ]);
        }

        return redirect('/students/lesson-plan')->with('success', 'File uploaded successfully.');
        
    }

    public function getDownload($pdf_name){
        $this->unauthorized_action();
        $file= public_path(). "/files/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function delete_pdf($pdf_name, $id) {
        $this->unauthorized_action();
        if(file_exists(public_path(). "/files/" . base64_decode($pdf_name))){

            unlink(public_path(). "/files/" . base64_decode($pdf_name));

            Lesson::findOrFail(base64_decode($id))->delete();

            return redirect()->back()->with('success-delete', 'File deleted successfully'); 

        } else {

            return redirect()->back()->with('unsuccess-delete', 'File not found'); 

        }
    }

    public function show_std_material(){
        $this->unauthorized_action();
        $materials = Material::paginate(20);
        return view('students.std_material', compact('materials'));
    }

    public function study_material_upload(){
        $this->unauthorized_action();
        $classes = Student::select('class')->groupBy('class')->get()->toArray();
        $sections = Student::select('section')->groupBy('section')->get()->toArray();
        return view('students.upload_std_material' , compact('classes', 'sections'));
    }

    public function upload_std_material_pdf(Request $request){
        $this->unauthorized_action();
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
            'class_section' => $attributes['class'] . ' ' .$attributes['section'],
            'material_pdf' => str_replace(" ", "_", $uniqueFileName),
        ]);

        return redirect('/students/study-material')->with('success', 'File uploaded successfully.');
        
    }

    public function get_download($pdf_name){
        
        $file= public_path(). "/files/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function get_download_material($pdf_name){
        
        $file= public_path(). "/files/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function delete_pdf_material($pdf_name, $id) {
        $this->unauthorized_action();
        if(file_exists(public_path(). "/files/" . base64_decode($pdf_name))){

            unlink(public_path(). "/files/" . base64_decode($pdf_name));

            Material::findOrFail(base64_decode($id))->delete();

            return redirect()->back()->with('success-delete', 'File deleted successfully'); 

        } else {

            return redirect()->back()->with('unsuccess-delete', 'File not found'); 

        }
    }

    public function create(){  
        $this->unauthorized_action();
        return view('events.create');
    }

    public function show_events(){  
        $events = Event::all();
        return view('events.calendar', compact('events'));
    }

    public function store(Request $request){
        $this->unauthorized_action();
        Event::create($request->all());
        return redirect()->route('show-events');
    }

    public function create_namaz_timing(){
        $this->unauthorized_action();
        return view('students.namaz_timing');
    }

    public function store_namaz_timing(Request $request){
        $this->unauthorized_action();
        Namaz::create($request->all());
        return redirect('/');
    }

    public function edit_namaz_timing($id){
        $this->unauthorized_action();
        $namaz = Namaz::findOrFail(base64_decode($id));
        return view('students.edit_namaz_timing', compact('namaz'));
    }

    public function view_namaz_timing(){
        $namazs = Namaz::all();
        return view('students.view_namaz', compact('namazs'));
    }

    public function store_edited_namaz_timing(Namaz $namaz){
        $this->unauthorized_action();
        $namaz->update([
            'namaz_title' => request('namaz_title'),
            'namaz_timing' => request('namaz_timing')
        ]);
        return redirect('/');
    }

    public function create_notification(){
        $this->unauthorized_action();
        $classes = Student::select('class')->groupBy('class')->get()->toArray();
        $sections = Student::select('section')->groupBy('section')->get()->toArray();
        return view('notification.add_notification', compact('classes', 'sections'));
    }

    public function create_noticeboaord(){
        $this->unauthorized_action();
        return view('notification.add_noticeboaord');
    }

    public function create_dua(){
        $this->unauthorized_action();
        return view('dua.create_dua');
    }

    public function view_noticeboard() {
        $this->unauthorized_action();
        $noticeboards = Noticeboard::all();
        return view('notification.view_noticeboard', compact('noticeboards'));
    }

    public function view_dua() {
        $this->unauthorized_action();
        $duas = Dua::all();
        return view('dua.view_dua', compact('duas'));
    }

    public function delete_noticeboard($id, $pdf) {
        // dd($pdf);
        $this->unauthorized_action();
        if(file_exists(public_path(). "/files/" . base64_decode($pdf))){

            unlink(public_path(). "/files/" . base64_decode($pdf));

            Noticeboard::findOrFail(base64_decode($id))->delete();

            return redirect()->back()->with('success-delete', 'File deleted successfully'); 

        } else {

            return redirect()->back()->with('unsuccess-delete', 'File not found'); 

        }
    }

    public function delete_dua($id, $pdf) {
        // dd($pdf);
        $this->unauthorized_action();
        if(file_exists(public_path(). "/files/" . base64_decode($pdf))){

            unlink(public_path(). "/files/" . base64_decode($pdf));

            Dua::findOrFail(base64_decode($id))->delete();

            return redirect()->back()->with('success-delete', 'File deleted successfully'); 

        } else {

            return redirect()->back()->with('unsuccess-delete', 'File not found'); 

        }
    }

    public function store_noticeboaord(Request $request){
        $this->unauthorized_action();
        // dd($request->all());

        $attributes = $this->validate($request, [
            'std_noticeboard_title'  => 'required',
            'std_notification'  => 'required',
            'noticeboard_pdf'  => 'required|mimes:pdf'
        ]);

        $uniqueFileName = $attributes['std_noticeboard_title'] . '.' .
        $request->file('noticeboard_pdf')->getClientOriginalExtension();
        $request->file('noticeboard_pdf')->move(public_path('files') , 
        str_replace(" ", "_", $uniqueFileName));
        // dd($attributes);
        NoticeBoard::create([
            'std_noticeboard_title' => $attributes['std_noticeboard_title'],
            'std_notification' => $attributes['std_notification'],
            'noticeboard_pdf' => str_replace(" ", "_", $uniqueFileName),
            ]
        );
        return redirect('/student/noticeboard/view')
            ->with('success', 'File uploaded successfully.');
    }

    public function store_dua(Request $request){
        $this->unauthorized_action();
        // dd($request->all());

        $attributes = $this->validate($request, [
            'std_dua_title'  => 'required',
            'std_dua_body'  => 'required',
            'dua_pdf'  => 'required|mimes:pdf'
        ]);

        $uniqueFileName = $attributes['std_dua_title'] . '.' .
        $request->file('dua_pdf')->getClientOriginalExtension();
        $request->file('dua_pdf')->move(public_path('files') , 
        str_replace(" ", "_", $uniqueFileName));
        // dd($attributes);
        Dua::create([
            'std_dua_title' => $attributes['std_dua_title'],
            'std_dua_body' => $attributes['std_dua_body'],
            'dua_pdf' => str_replace(" ", "_", $uniqueFileName),
            ]
        );
        return redirect('/student/dua/view')
            ->with('success', 'File uploaded successfully.');
    }

    public function show_complaints(){
        $complaints = Complaint::paginate(20);
        return view('students.std_complaints', compact('complaints'));
    }

    public function autocomplete(Request $request){
        $input = $request->all();
        $term = $input['data'];
        $result = array();
        if(!empty($term)){
            $students = Student::where('reg_no','LIKE','%'.$term.'%')
            ->take(10)->get();
            $output = '<ul class="w-100 dropdown-menu" 
            style="display:block; position:relative">';
            foreach($students as $student)
            {
                $output .= '
                <li class="lead">'.$student->reg_no.'</li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        } else {
            $result = [];
        }
    }

    public function complaints_upload(){
        $this->unauthorized_action();
        $com_nos = Student::select('com_no')->get()->toArray();
        return view('students.upload_std_complaint', compact('com_nos'));
    }

    public function upload_complaints_pdf(Request $request){
        $this->unauthorized_action();
        $attributes = $this->validate($request, [
            'complaint_name'  => 'required',
            'complaint_description'  => 'required',
            'student_complaint'  => 'required|mimes:pdf',
            'reg_no'  => 'required'
        ]);
        
        $uniqueFileName = $attributes['complaint_name'] . '.' .
        $request->file('student_complaint')->getClientOriginalExtension();
        $request->file('student_complaint')->move(public_path('files') , str_replace(" ", "_", $uniqueFileName));

        Complaint::create([
            'complaint_name' => $attributes['complaint_name'],
            'complaint_description' => $attributes['complaint_description'],
            'complaint_pdf' => str_replace(" ", "_", $uniqueFileName),
            'reg_no' => $attributes['reg_no'],
        ]);

        return redirect('/students/complaints')->with('success', 'File uploaded successfully.');
        
    }

    public function delete_pdf_complaintsl($pdf_name, $id) {
        $this->unauthorized_action();
        if(file_exists(public_path(). "/files/" . base64_decode($pdf_name))){

            unlink(public_path(). "/files/" . base64_decode($pdf_name));

            Complaint::findOrFail(base64_decode($id))->delete();

            return redirect()->back()->with('success-delete', 'File deleted successfully'); 

        } else {

            return redirect()->back()->with('unsuccess-delete', 'File not found'); 

        }
    }

    public function show_children(){

        $childrens = auth()->user()->students;
        return view('children.show_children', compact('childrens'));

    }

    public function show_children_study_material(){

        $studentss = auth()->user()->students;
        $students = [];
        foreach($studentss as $key => $student) {
            if($student->materials->isEmpty()){
                $students[$key] = null;
             }
            else {
                $students[$key] = $student->materials;
            }
        }
        // dd($students);
        return view('children.show_children_study_material', compact('students'));  
    }

    public function show_children_lesson_plan(){

        $studentss = auth()->user()->students;
        $students;
        foreach($studentss as $key => $student) {
            if($student->lessons->isEmpty()){
                $students[$key] = null;
             }
            else {
                $students[$key] = $student->lessons;
            }
        }
        return view('children.show_children_lesson_plan', compact('students'));  
    }

    public function getDownloadInvoice($pdf_name){
        // $this->unauthorized_action();
        $file= public_path(). "/uploads/invoices/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function getDownloadResult($pdf_name){
        // $this->unauthorized_action();
        $file= public_path(). "/uploads/results/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function getDownloadDatesheet($pdf_name){
        // $this->unauthorized_action();
        $file= public_path(). "/uploads/date_sheet/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function getDownloadAttendance($pdf_name){
        // $this->unauthorized_action();
        $file= public_path(). "/uploads/attendance/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function getDownloadDua($pdf_name){
        // $this->unauthorized_action();
        $file= public_path(). "/uploads/islamic_dua/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function getDownloadNoticeboard($pdf_name){
        // $this->unauthorized_action();
        $file= public_path(). "/uploads/notice_board/" . base64_decode($pdf_name);

        $headers = array(
                'Content-Type: application/pdf',
                );      

        return response()->download($file, 'filename.pdf', $headers);
    }
}

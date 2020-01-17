@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <form action="{{ route('edit-student', ['id' => base64_encode($student['id'])]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="card">
            <div class="card-header">
                {{ auth()->user()->user_type == 2 ? 'View Student' : 'Edit Student' }}
            </div>
            <div class="card-body">
        <div class="form-group">
            <label for="">Com No</label>
            <input readonly type="text" name="com_no" class="form-control" value="{{ $student['com_no'] }}">
        </div>

        <div class="form-group">
            <label for="">Registration No</label>
            <input type="text" name="reg_no" class="form-control" value="{{ $student['reg_no'] }}">
        </div>

        <div class="form-group">
            <label for="">Student Name</label>
            <input type="text" name="student_name" class="form-control" value="{{ $student['student_name'] }}">
        </div>

        <div class="form-group">
            <label for="">Father Name</label>
            <input type="text" name="father_name" class="form-control" value="{{ $student['father_name'] }}">
        </div>

        <div class="form-group">
            <label for="">Gender</label>
            <input type="text" name="gender" class="form-control" value="{{ $student['gender'] }}">
        </div>

        <div class="form-group">
            <label for="">Date of Birth</label>
            <input type="text" name="dob" class="form-control" value="{{ $student['dob'] }}">
        </div>

        <div class="form-group">
            <label for="">Class</label>
            <input type="text" name="class" class="form-control" value="{{ $student['class'] }}">
        </div>

        <div class="form-group">
            <label for="">Section</label>
            <input type="text" name="section" class="form-control" value="{{ $student['section'] }}">
        </div>

        <div class="form-group">
            <label for="">Father CNIC</label>
            <input type="text" name="father_cnic" class="form-control" value="{{ $student['father_cnic'] }}">
        </div>

        <div class="form-group">
            <label for="">Father Mobile</label>
            <input type="text" name="father_mobile" class="form-control" value="{{ $student['father_mobile'] }}">
        </div>
        
        @foreach($student->std_complaints as $key => $complaint)
            <div class="form-group">
                <label for="">Complaint No {{$key + 1}}</label>
                <a class="btn btn-success btn-sm float-right" 
                                href="{{ route('download-pdf', 
                                ['pdf' => base64_encode($complaint['complaint_pdf'])]) }}">
                                    <i class="fas fa-download"></i>
                </a>
            </div>
        @endforeach

        <div class="form-group">
            <label for="">Result</label>
            <a class="btn btn-success btn-sm float-right" 
                            href="{{ route('download-pdf-result', 
                            ['pdf' => base64_encode($student['results'])]) }}">
                                <i class="fas fa-download"></i>
            </a>
        </div>

        <div class="form-group">
            <label for="">Invoice</label>
            <a class="btn btn-success btn-sm float-right" 
                            href="{{ route('download-pdf-invoice', 
                            ['pdf' => base64_encode($student['invoices'])]) }}">
                                <i class="fas fa-download"></i>
            </a>
        </div>

        <div class="form-group">
            <label for="">Attendance</label>
            <a class="btn btn-success btn-sm float-right" 
                            href="{{ route('download-pdf-attendance', 
                            ['pdf' => base64_encode($student['attendance'])]) }}">
                                <i class="fas fa-download"></i>
            </a>
        </div>

        <div class="form-group">
            <label for="">Date Sheet</label>
            <a class="btn btn-success btn-sm float-right" 
                            href="{{ route('download-pdf-datesheet', 
                            ['pdf' => base64_encode($student['date_sheet'])]) }}">
                                <i class="fas fa-download"></i>
            </a>
        </div>

        <div class="form-group">
            <label for="">Islamic Dua</label>
            <a class="btn btn-success btn-sm float-right" 
                            href="{{ route('download-pdf-dua', 
                            ['pdf' => base64_encode($student['islamic_dua'])]) }}">
                                <i class="fas fa-download"></i>
            </a>
        </div>

        <div class="form-group">
            <label for="">Noticeboard</label>
            <a class="btn btn-success btn-sm float-right" 
                            href="{{ route('download-pdf-noticeboard', 
                            ['pdf' => base64_encode($student['notice_board'])]) }}">
                                <i class="fas fa-download"></i>
            </a>
        </div>


        @if(auth()->user()->user_type == 1)
        <div class="form-group">
            <button class="btn btn-primary">Update</button>
        </div>
        @endif
    </div>
    </div>
    </form>
@endsection
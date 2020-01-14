@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <form action="{{ route('edit-student', ['id' => base64_encode($student['id'])]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="card">
            <div class="card-header">
                Edit Student
            </div>
            <div class="card-body">
        <div class="form-group">
            <label for="">Com No</label>
            <input type="text" name="com_no" class="form-control" value="{{ $student['com_no'] }}">
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

        <div class="form-group">
            <button class="btn btn-primary">Update</button>
        </div>
    </div>
    </div>
    </form>
@endsection
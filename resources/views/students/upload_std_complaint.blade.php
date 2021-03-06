@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           Upload Complaints
        </div>
        <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                Upload Validation Error<br><br>
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                    <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
                @endif
                
            <form action={{ route ('students-complaints-upload-pdf')}} method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Complaint Name</label>
                    <input type="text" name="complaint_name" class="form-control" placeholder="Complaint">
                </div>

                <div class="form-group">
                    <label for="">Complaint Description</label>
                    <textarea class="form-control" rows="4" name="complaint_description" placeholder="Complaint Description"></textarea>
                </div>

                <div class="form-group">
                        <label for="reg_no">Student Registration Number</label>
                        <input name="reg_no" id="reg_no" type="text" class="form-control">
                        <div id="countryList">
                        </div>
                </div>

                <div class="form-group">
                    <label for="">Upload Complaint</label>
                    <div class="custom-file">
                        <input name="student_complaint" class="custom-file-input" 
                        type="file" id="student_complaint">
                        <label class="custom-file-label" for="student_excel">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Upload</button>
                    <a class="btn btn-secondary" href="{{ route('students-complaints') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
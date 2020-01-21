@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           Noticeboard
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
                
            <form action={{ route ('student-noticeboaord-store')}} method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input name="std_notification_title" id="std_notification_title" rows="3" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Body</label>
                    <textarea name="std_notification" id="std_notification" rows="3" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Upload File</label>
                    <div class="custom-file">
                        <input name="student_complaint" class="custom-file-input" 
                        type="file" id="student_complaint">
                        <label class="custom-file-label" for="student_excel">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Upload</button>
                    {{-- <a class="btn btn-secondary" href="{{ route('students-complaints') }}">Cancel</a> --}}
                </div>
            </form>
        </div>
    </div>
@endsection
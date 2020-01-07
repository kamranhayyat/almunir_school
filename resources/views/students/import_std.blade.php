@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           Import Students
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
            
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
                @endif

                @if($message = Session::get('unsuccessful'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
                @endif
            <form action={{ route ('import-students-excel')}} method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Import Excel</label>
                    <div class="custom-file">
                        <input name="student_excel" class="custom-file-input" 
                        type="file" id="student_excel">
                        <label class="custom-file-label" for="student_excel">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Import</button>
                    <a class="btn btn-secondary" href="{{ route('show-students') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
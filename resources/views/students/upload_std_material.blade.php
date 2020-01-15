@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           Upload Student Study Material
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
                
            <form action={{ route ('students-study-material-upload-pdf')}} method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Material Name</label>
                    <input type="text" name="material_name" class="form-control" placeholder="Material">
                </div>

                <div class="form-group">
                    <label for="">Material Description</label>
                    <textarea class="form-control" rows="4" name="material_description" placeholder="Material Description"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Class</label>
                    <select name="class" id="class" class="form-control">
                        <option selected>Please Select Class</option>
                        @foreach ($classes as $class)
                            <option>{{$class['class'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Section</label>
                    <select name="section" id="section" class="form-control">
                        <option selected>Please Select Section</option>
                        @foreach ($sections as $section)
                            <option>{{$section['section'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Upload Material</label>
                    <div class="custom-file">
                        <input name="student_material" class="custom-file-input" 
                        type="file" id="student_material">
                        <label class="custom-file-label" for="student_excel">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Upload</button>
                    <a class="btn btn-secondary" href="{{ route('students-study-material') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
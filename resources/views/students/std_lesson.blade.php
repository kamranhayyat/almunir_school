@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Lesson Plans
            <a href="{{ route('students-lesson-plan-upload') }}"><button class="btn btn-primary btn-sm float-right">Upload Student Lesson</button></a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Lesson name</th>
                    <th>Lesson</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Operations</th>
                </thead>
                <tbody>
                    @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    {{-- @foreach($students as $student)
                    <tr>
                        <td>{{$student['roll_no']}}</td>
                        <td>{{$student['student_name']}}</td>
                        <td>{{$student['user_id']}}</td>
                        <td>{{$student['admission_date']}}</td>
                        <td>{{$student['class'] . ' / ' . $student['section']}}</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm">Operations</button></td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
            {{-- pagination --}}
            {{-- {{$students->links()}} --}}
        </div>
    </div>
@endsection
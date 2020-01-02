@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Students
            <a href="{{ route('import-students') }}"><button class="btn btn-primary btn-sm float-right">Import Students</button></a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>ID</th>
                    <th>Full ame</th>
                    <th>Username</th>
                    <th>Admission Date</th>
                    <th>Class / Section</th>
                    <th>Operations</th>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{$student['roll_no']}}</td>
                        <td>{{$student['student_name']}}</td>
                        <td>{{$student['user_id']}}</td>
                        <td>{{$student['admission_date']}}</td>
                        <td>{{$student['class'] . ' / ' . $student['section']}}</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm">Operations</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- pagination --}}
            {{$students->links()}}
        </div>
    </div>
@endsection
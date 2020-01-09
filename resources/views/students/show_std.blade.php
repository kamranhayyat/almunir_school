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
                    <th>Full name</th>
                    <th>Father name</th>
                    <th>Date of birth</th>
                    <th>Class / Section</th>
                    <th>Operations</th>
                </thead>
                <tbody>
                    @if($message = Session::get('success-delete'))
                    <div class="alert alert-secondary alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @foreach($students as $student)
                    <tr>
                        <td><i style="color:{{ $student['status'] == 1 ? 'green' : 'red'}}" class="fas fa-lightbulb mr-2"></i>{{$student['roll_no']}}</td>
                        <td>{{$student['student_name']}}</td>
                        <td>{{$student['father_name']}}</td>
                        <td>{{$student['dob']}}</td>
                        <td>{{$student['class'] . ' / ' . $student['section']}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Operations
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <form action="{{ route('delete-student', ['id' => base64_encode($student['id'])]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="dropdown-item">Delete</button>
                                    </form>
                                    <form action="{{ route('toggle-student', ['id' => base64_encode($student['id'])]) }}" method="POST">
                                        @csrf
                                    <button type="submit" class="dropdown-item">Toggle Status</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- pagination --}}
            {{$students->links()}}
        </div>
    </div>
@endsection
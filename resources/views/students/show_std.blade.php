@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Students
           <a href="{{ route('import-students') }}"><button class="btn btn-primary btn-sm float-right ml-2">Import Students</button></a>
           <button class="btn btn-secondary btn-sm float-right ml-2" data-toggle="modal" data-target="#exampleModal">Search Student</button>
           @if($request->has('search'))
            <a href="{{ route('show-students') }}" class="btn btn-secondary btn-sm float-right text-white">Reset</a>
           @endif
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('show-students') }}">
                    {{-- @csrf --}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Search</label>
                            <input type="text" name="wildcard" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Gender</label><br>
                            <input type="radio" name="gender" class="mr-2">Male <br>
                            <input type="radio" name="gender" class="mr-2">Female
                        </div>

                        <div class="form-group">
                            <label for="">Class</label><br>
                            <select name="class" id="" class="form-control">
                                <option selected>Please Select Class</option>
                                @foreach($classes as $class)
                                <option>{{ $class['class'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Section</label><br>
                            <select name="section" id="" class="form-control">
                                <option selected>Please Select Section</option>
                                @foreach($sections as $section)
                                <option>{{ $section['section'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="search">Search</button>
                    </div>
                </form>
            </div>
            </div>
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

                    @if($message = Session::get('success-update'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @foreach($students as $student)
                    <tr>
                        <td><i style="color:{{ $student['status'] == 1 ? 'green' : 'red'}}" class="fas fa-lightbulb mr-2"></i>{{$student['reg_no']}}</td>
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
                                    
                                    <a href="{{ route('show-student', ['id' => base64_encode($student['id'])]) }}" class="dropdown-item">Edit</a>
                                    
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
            {{$students->appends($_GET)->links()}}
        </div>
    </div>
@endsection
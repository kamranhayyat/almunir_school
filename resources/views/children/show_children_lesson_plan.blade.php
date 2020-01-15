@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Student Lessons
            {{-- <a href="{{ route('students-study-material-upload') }}"><button class="btn btn-primary btn-sm float-right">Upload Student Material</button></a> --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Title</th>
                    <th>Lesson Description</th>
                    <th>Class/Section</th>
                    <th>Operations</th>
                </thead>
                <tbody>
                    @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    @if($message = Session::get('success-delete'))
                    <div class="alert alert-secondary alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    @if($message = Session::get('unsuccess-delete'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @foreach($students as $key => $lesson)
                    <tr>
                        <?php 
                        // print_r($lesson[1]);exit;
                        dd($lesson[0]);
                        if($lesson[$key] == null)
                        {   
                            continue;
                        }
                        ?>
                        <td>{{$lesson[$key]['lesson_name']}}</td>
                        <td>{{$lesson[$key]['lesson_description']}}</td>
                        <td>{{$lesson[$key]['class_section']}}</td>
                        <td>
                            <a class="btn btn-success btn-sm" 
                            href="{{ route('download-pdf', 
                            ['pdf' => base64_encode($lesson[$key]['lesson_pdf'])]) }}">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                    </tr>   
                    @endforeach
                </tbody>
            </table>
            {{-- pagination --}}
            {{-- {{$students->links()}} --}}
        </div>
    </div>
@endsection
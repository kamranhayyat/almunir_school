@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Lessons
            <a href="{{ route('students-lesson-plan-upload') }}"><button class="btn btn-primary btn-sm float-right">Upload Student Lesson</button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>Lesson name</th>
                        <th>Lesson</th>
                        {{-- <th>Class</th>
                        <th>Section</th> --}}
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
                        @foreach($lessons as $lesson)
                        <tr>
                        <?php 
                            $arr = explode(" ", $lesson['class_section']);
                        ?>
                            <td>{{$lesson['lesson_name']}}</td>
                            <td>{{$lesson['lesson_pdf']}}</td>
                            {{-- <td>{{$arr[0]}}</td>
                            <td>{{$arr[1]}}</td> --}}
                            <td>
                                <a class="btn btn-success btn-sm" 
                                href="{{ route('download-pdf', 
                                ['pdf' => base64_encode($lesson['lesson_pdf'])]) }}">
                                    <i class="fas fa-download"></i>
                                </a>
                                <form style="display:inline!important;" method="POST" 
                                action="{{ route('delete-pdf', ['pdf' => base64_encode($lesson['lesson_pdf']),
                                'id' => base64_encode($lesson['id'])]) }}">
                                    @method('DELETE')
                                    @csrf    
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- pagination --}}
            {{$lessons->links()}}
        </div>
    </div>
@endsection
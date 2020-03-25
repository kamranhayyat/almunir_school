@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Noticeboard
            {{-- <a href="{{ route('students-study-material-upload') }}"><button class="btn btn-primary btn-sm float-right">Upload Student Material</button></a> --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Title</th>
                    <th>Noticeboard</th>
                    <th>Operations</th>
                </thead>
                <tbody>

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
                    @foreach($noticeboards as $key => $noticeboard)
                    <tr>
                        <td>{{$noticeboard['std_noticeboard_title']}}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" 
                            href="{{ route('show-pdf', 
                            ['pdf' => base64_encode($noticeboard['noticeboard_pdf'])]) }}">
                              View  <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('delete-noticeboard', ['id' => base64_encode($noticeboard['id']), 'pdf' => base64_encode($noticeboard['noticeboard_pdf']) ]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
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
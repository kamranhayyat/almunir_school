@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Stdent Complaints
            <a href="{{ route('students-complaints-upload') }}"><button class="btn btn-primary btn-sm float-right">Upload Complaints</button></a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th style="width:30%">Title</th>
                    <th>Complaint</th>
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
                    @foreach($complaints as $complaint)
                    <tr>
                        <td>{{$complaint['complaint_name']}}</td>
                        <td>{{$complaint['complaints_pdf']}}</td>
                        <td>
                            <a class="btn btn-success btn-sm" 
                            href="{{ route('download-pdf-complaints', 
                            ['pdf' => base64_encode($complaint['complaint_pdf'])]) }}">
                                <i class="fas fa-download"></i>
                            </a>
                            <form style="display:inline!important;" method="POST" 
                            action="{{ route('delete-pdf-complaints', ['pdf' => base64_encode($complaint['complaint_pdf']),
                             'id' => base64_encode($complaint['id'])]) }}">
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
            {{-- pagination --}}
            {{$complaints->links()}}
        </div>
    </div>
@endsection
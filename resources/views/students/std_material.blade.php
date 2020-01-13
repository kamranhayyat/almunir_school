@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Study Material
            <a href="{{ route('students-study-material-upload') }}"><button class="btn btn-primary btn-sm float-right">Upload Student Material</button></a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Title</th>
                    <th>Study Material</th>
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
                    @foreach($materials as $material)
                    <tr>
                        <td>{{$material['material_name']}}</td>
                        <td>{{$material['material_pdf']}}</td>
                        <td>{{$material['class']}}</td>
                        <td>{{$material['section']}}</td>
                        <td>
                            <a class="btn btn-success btn-sm" 
                            href="{{ route('download-pdf-material', 
                            ['pdf' => base64_encode($material['material_pdf'])]) }}">
                                <i class="fas fa-download"></i>
                            </a>
                            <form style="display:inline!important;" method="POST" 
                            action="{{ route('delete-pdf-material', ['pdf' => base64_encode($material['material_pdf']),
                             'id' => base64_encode($material['id'])]) }}">
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
            {{$materials->links()}}
        </div>
    </div>
@endsection
@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')

    <div class="card">
        <div class="card-header">
           List Namaz Timings 
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Title</th>
                    <th>Timing</th>
                    <th>Operations</th>
                </thead>
                <tbody>
                    @if($message = Session::get('unsuccess-delete'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @foreach($namazs as $namaz)
                    <tr>
                        <td>{{$namaz['namaz_title']}}</td>
                        <td>{{date('h:i', strtotime($namaz['namaz_timing']))}}</td>
                        <td>
                            <a class="btn btn-success btn-sm" 
                            href="{{ route('edit-namaz-timings', 
                            ['id' => base64_encode($namaz['id'])]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
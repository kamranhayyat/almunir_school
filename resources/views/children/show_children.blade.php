@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           List Students
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>ID</th>
                    <th>Full name</th>
                    {{-- <th>Father name</th>
                    <th>Date of birth</th>
                    <th>Class / Section</th> --}}
                    <th>Operations</th>
                </thead>
                <tbody>
                    @if($message = Session::get('success-delete'))
                    <div class="alert alert-secondary alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @foreach($childrens as $children)
                    <tr>
                        <td><i style="color:{{ $children['status'] == 1 ? 'green' : 'red'}}" class="fas fa-lightbulb mr-2"></i>
                            <img src="{{asset('images/kid.jpg')}}" alt="" style="max-width:40px; border-radius: 5px;">
                            {{$children['reg_no']}}</td>
                        <td>{{$children['student_name']}}</td>
                        {{-- <td>{{$children['father_name']}}</td>
                        <td>{{$children['dob']}}</td>
                        <td>{{$children['class'] . ' / ' . $children['section']}}</td> --}}
                        <td><a href="{{ route('edit-student', ['id' => base64_encode($children['id'])]) }}" class="btn btn-info btn-sm text-white">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            {{-- pagination --}}
            {{-- {{$childrens->links()}} --}}
        </div>
    </div>
@endsection
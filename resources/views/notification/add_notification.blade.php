@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="card">
        <div class="card-header">
           Notification
        </div>
        <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                Upload Validation Error<br><br>
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                    <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
                @endif
                
            <form action={{ route ('student-notification-store')}} method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Options</label>
                    <select onchange="show_fields(this.value)" class="form-control" name="std_notification" id="std_notification">
                        <option selected value="">Please Choose Your Desired Option</option>
                        <option value="1">Class Wise</option>
                        <option value="2">Class & Section Wise</option>
                        <option value="3">General Notification</option>
                    </select>
                </div>

                <div class="form-group" id="std_class" style="display:none;">
                    <label for="">Class</label>
                    <select name="class" id="class" class="form-control">
                        <option value="">Please Choose Class</option>
                        @foreach($classes as $class)
                            <option>{{ $class['class'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="std_section" style="display:none;">
                    <label for="">Section</label>
                    <select name="class" id="class" class="form-control">
                        <option value=""> Please Choose Section</option>
                        @foreach($sections as $section)
                            <option>{{ $section['section'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Notification</label>
                    <textarea name="body" id="body" rows="3" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection
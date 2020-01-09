@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
<div class="card">
    <div class="card-header">Add Notification</div>
    <div class="card-body">
        <form action="{{ route('student-notification-store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Notification Title</label>
                <input name="std_notification_title" id="std_notification_title" rows="3" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Notification Body</label>
                <textarea name="std_notification" id="std_notification" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
               <button class="btn btn-primary" type="submit">Save</button>
            </div>
          </form>
    </div>
</div>
    
@endsection
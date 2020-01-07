@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
<div class="card">
    <div class="card-header">Add Event</div>
    <div class="card-body">
        <form action="{{ route('store-event') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Event name</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Event description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="">Event date</label>
                <input type="date" name="event_date" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
    </div>
</div>
    
@endsection
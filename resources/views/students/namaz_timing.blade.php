@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
<div class="card">
    <div class="card-header">Add Namaz Timing</div>
    <div class="card-body">
        <form action="{{ route('store-namaz-timings') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Namaz Title</label>
                <input type="text" name="namaz_title" id="namaz_title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Namaz Timing</label>
                <input type="time" name="namaz_timing" id="namaz_timing" class="form-control">
            </div>
            <div class="form-group">
               <button class="btn btn-primary" type="submit">Save</button>
            </div>
          </form>
    </div>
</div>
    
@endsection
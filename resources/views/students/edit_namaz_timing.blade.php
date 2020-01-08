@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
<div class="card">
    <div class="card-header">Edit Namaz Timing</div>
    <div class="card-body">
        <form action="{{ route('store-namaz-timings-edit', ['namaz' => $namaz['id']]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">Namaz Title</label>
                <input type="text" value="{{ $namaz['namaz_title'] }}" name="namaz_title" id="namaz_title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Namaz Timing</label>
                <input type="time" value="{{ $namaz['namaz_timing'] }}" name="namaz_timing" id="namaz_timing" class="form-control">
            </div>
            <div class="form-group">
               <button class="btn btn-primary" type="submit">Update</button>
            </div>
          </form>
    </div>
</div>
    
@endsection
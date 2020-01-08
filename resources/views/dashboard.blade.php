@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    <div class="display-4 mb-3">
        Namaz Timings
    </div>
    <div class="lead bg-dark text-white rounded p-3">
        <marquee behavior="scroll" direction="left" 
        onmouseover="this.stop();" 
        onmouseout="this.start();">
            @foreach($namazs as $namaz)
                {{ $namaz['namaz_title'].'    '.date('h:i', strtotime($namaz['namaz_timing'])) }}
            @endforeach
        </marquee>
    </div>
@endsection
@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    @if(isset($namazs) && !empty($namazs) && auth()->user()->user_type == 1)
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
    @endif

    @if(isset($namazs) && auth()->user()->user_type == 2)
    <div class="display-4 mb-2">Notifications</div>
    @foreach($notifications as $notification)
        <div class="card mb-3">
            <div class="card-header">
                {{ $notification['std_notification_title'] }}
            </div>
            <div class="card-body">
                {{ $notification['std_notification'] }}
            </div>
        </div>
    @endforeach
    @endif
@endsection
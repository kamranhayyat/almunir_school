@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('content')
    @if(auth()->user()->user_type == 1 || auth()->user()->user_type == 2)
        <div class="display-4 mb-3">
            Namaz Timings
        </div>
        <div class="lead bg-primary text-white rounded p-3 mb-3">
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
    <div class="display-4 mb-2">Noticeboard</div>
    @foreach($notifications as $notification)
        <div class="card mb-3">
            <div class="card-header">
                {{ $notification['std_notification_title'] }}
                <a class="btn btn-warning btn-sm float-right" 
                                href="{{ route('pdf', 
                                ['pdf' => base64_encode($notification['notification_pdf'])]) }}">
                                  View  <i class="fas fa-file-pdf"></i>
                </a>
            </div>
            <div class="card-body">
                {{ $notification['std_notification'] }}
            </div>
            @if(!empty($notification['student_complaint']) &&
             isset($notification['student_complaint']))
                <div class="ml-3 mr-3 mb-3">
                    <label for="" class="lead font-weight-bold">Noticeboard pdf</label>
                    <a class="btn btn-success btn-sm float-right ml-3" 
                                    href="{{ route('download-pdf', 
                                    ['pdf' => base64_encode($notification['student_complaint'])]) }}">
                                        <i class="fas fa-download"></i>
                    </a>  
                    <a class="btn btn-warning btn-sm float-right" 
                    href="{{ route('pdf', 
                    ['pdf' => base64_encode($notification['student_complaint'])]) }}">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>
            @endif
        </div>
    @endforeach
    @endif
@endsection
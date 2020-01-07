@extends('layouts.app_layout')

@section('title', 'Almunir Schools')

@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
@endsection

@section('content')
    
    <div id='calendar'></div>

@endsection

@section('scripts')
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events : [
                    @foreach($events as $task)
                    {
                        title : '{{ $task->title }}',
                        start : '{{ $task->event_date }}',
                    },
                    @endforeach
                ]
            })
        });
    </script>
@endsection
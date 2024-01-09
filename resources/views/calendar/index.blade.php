@extends('layouts.app-master')

@section('content-employ')
    <link rel="stylesheet" type="text/css" href="assets/calendar/css/evo-calendar.css"/>
    <link rel="stylesheet" type="text/css" href="assets/calendar/css/evo-calendar.royal-navy.css"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
    <script src="assets/calendar/js/evo-calendar.js" defer></script>

    <div class="halaman">
    <div id="calendar"></div>
    </div>

    <script>
    // initialize your calendar, once the page's DOM is ready
    $(document).ready(function() {
    var events = @json($events);
    var presen = @json($presen);
    
    var eventsAndPresen = events.concat(presen);
    
    $('#calendar').evoCalendar({
        theme: 'Royal Navy',
        calendarEvents: eventsAndPresen,
        'format': 'MM dd, yyyy',
        'titleFormat': 'MM',

            

        });
    });

    </script>

    <style>
 
        .halaman{
            /* width: 100%;
            height: 100%; */
            /* background: linear-gradient(45deg,#6ac1c5,#bda5ff); */
            /* position: relative; */
            margin-top: 20px;
            margin-bottom: 20px;

        }
        #calendar{
            width: 80%;
            /* position: absolute; */
            /* top: 50%; */
            /* left:50%; */
            
        }
    </style>
@endsection
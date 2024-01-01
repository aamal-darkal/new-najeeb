@extends('layouts.master')
@section('content')
    <div class="padding">
        <div class="row m-b">
            <div class="col-sm-4 m-b-sm">
                <button type="button" class="btn btn-sm white" id="todayview">today</button>
            </div>
            <div class="col-sm-8 text-sm-right">
                <div class="btn-group m-l-xs">
                    <button class="btn btn-sm white" id="dayview">Day</button>
                    <button class="btn btn-sm white" id="weekview">Week</button>
                    <button class="btn btn-sm white" id="monthview">Month</button>
                </div>
            </div>
        </div>
        <div class="fullcalendar" ui-jp="fullCalendar"
            ui-options="{
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        initialDate: '2023-01-12',
        {{-- defaultView: 'agendaWeek', --}}
        {{-- nowIndicator: true, --}}
        defaultDate: '{{ \Carbon\Carbon::now()->toDateString() }}',
        editable: true,
        eventLimit: false,
        events: [
        {{ $lectures }}

        ]
      }">
        </div>
    </div>

    <!-- ############ PAGE END-->
@endsection

@extends('layouts.master')
@section('content')
    <div class="mt-2 ml-5">
        <a class="md-btn md-raised primary text-white" href="{{ route('packages.show', ['package' => $package]) }}"><i
                class="fas fa-long-arrow-left"></i></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="container-fluid">

                    <div class="row p-2 b-a b-primary b-2x text-center bg-white ">
                        <div class="col-6">
                            @if ($package->image)
                                <img src="{{ asset('storage/images/packages/' . $package->image) }}" width="100%"
                                    height="130px">
                            @else
                                <img src="{{ asset('storage/images/packages/no-image.png') }}" width="100%"
                                    height="130px">
                            @endif
                        </div>
                        <div class="p-2 text mt-1 col-6">
                            <div class=" _800">
                                <div class="text-primary">package Name: </div>
                                {{ $package->name }}
                            </div>
                            <div class="text-primary text _800">Starts at:
                                <div class="text-dark _100 ">{{ $package->start_date }}</div>
                            </div>
                            <div class="text-primary text _800">Ends at:
                                <div class="text-dark _100 ">{{ $package->end_date }}</div>
                            </div>
                        </div>
                    </div>

                    <div id='calendar'>

                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>

            {{-- ************** form box ***************** --}}
            <div class="col-md-5  p-2">
                <div class="box">
                    <div class="box-header text-primary">
                        <span class="label primary pull-right text-sm">{{ $package->subjects->count() + 1 }}</span>
                        <h2>Add subject</h2>
                    </div>
                    <div class="box-body">
                        <div class="text-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>

                        {{-- start time-template --}}
                        <div class="time-template" style="display: none">
                            <div class="time-item bg-light border p-2 my-2">
                                <div class="form-group">
                                    <label for="days">Day</label>
                                    <div class="col-auto my-1 text-center">
                                        <select name="days[]" id="days" class="form-control"required>
                                            @foreach ($weekDays as $weekDay)
                                                <option value="{{ $weekDay }}"=={{ $weekDay }}>
                                                    {{ $weekDay }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-5">
                                        <label for="start_times">Start time</label>
                                        <select name="start_times[]" id="start_times" class="form-control">
                                            @foreach ($times as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-5">
                                        <label for="end_times">End time</label>
                                        <select name="end_times[]" id="end_times" class="form-control">
                                            @foreach ($times as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-outline-danger mt-4"
                                            onclick="delete_time(this)" title="delete time">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end time-template --}}

                        <form role="form" method="POST" id="myForm" action="{{ route('subjects.store') }}">
                            @csrf
                            <input type="hidden" value="{{ $package->id }}" name="package_id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                                    placeholder="Enter Name" name="name" maxlength="100" required>
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="cost">Cost</label>
                                    <input type="number" class="form-control" id="cost" value="{{ old('cost') }}"
                                        placeholder="Enter Cost" name="cost" min=0 required>
                                    <div class="text-danger">
                                        @error('cost')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group  col-md-6"">
                                    <label for="color">Color</label>
                                    <input type="color" class="form-control p-0 m-0" id="color"
                                        value="{{ old('color') }}" name="color" required>
                                    <div class="text-danger">
                                        @error('color')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="time-wrapper">

                                {{-- has pre posted value (old) --}}
                                @php
                                    $days = old('days');
                                    $start_times = old('start_times');
                                    $end_times = old('end_times');
                                @endphp
                                @if ($days)
                                    @for ($i = 0; $i < count($days); $i++)
                                        <div class="time-item bg-light border p-2 my-2">
                                            <div class="form-group">
                                                <label for="days">Day</label>
                                                <div class="my-1 text-center">
                                                    <select class="form-control" id="days" name="days[]" required>
                                                        @foreach ($weekDays as $weekDay)
                                                            <option value="{{ $weekDay }}"
                                                                @selected($weekDay == $days[$i])>
                                                                {{ $weekDay }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-5">
                                                    <label for="start_times">Start time</label>
                                                    <select name="start_times[]" id="start_times" class="form-control">
                                                        @foreach ($times as $time)
                                                            <option value="{{ $time }}"
                                                                @selected($time == $start_times[$i])>
                                                                {{ $time }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-5">
                                                    <label for="end_times">End time</label>
                                                    <select name="end_times[]" id="end_times" class="form-control">
                                                        @foreach ($times as $time)
                                                            <option value="{{ $time }}"
                                                                @selected($time == $end_times[$i])>
                                                                {{ $time }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-1">
                                                    <button type="button" class="btn btn-outline-danger mt-4"
                                                        onclick="delete_time(this)" title="delete time">-</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    <div class="time-item bg-light border p-2 my-2">
                                        <div class="form-group">
                                            <label for="days">Day</label>
                                            <div class="my-1 text-center">
                                                <select class="form-control" id="days" name="days[]" required>
                                                    @foreach ($weekDays as $weekDay)
                                                        <option value="{{ $weekDay }}">{{ $weekDay }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-5">
                                                <label for="start_times">Start time</label>
                                                <select name="start_times[]" id="start_times" class="form-control">
                                                    @foreach ($times as $time)
                                                        <option>{{ $time }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-5">
                                                <label for="end_times">End time</label>
                                                <select name="end_times[]" id="end_times" class="form-control">
                                                    @foreach ($times as $time)
                                                        <option value="{{ $time }}">{{ $time }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <button type="button" class="btn btn-outline-danger mt-4"
                                                    onclick="delete_time(this)" title="delete time">-</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="">
                                <button type="button" class="btn text-primary border border-primary"
                                    onclick="plus_time()" title="Add another day">+</button>
                                <label class="text-primary ml-1" for=""> Add Another Day</label>
                            </div>
                            <button type="submit" class="btn primary my-2" id="submit-btn">Add Subject</button>
                        </form>
                        <div class="hidden">
                            {{ $weekprogs }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    @endpush
    @push('js')
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

        {{-- calander --}}
        <script src="{{ asset('scripts/calander.global.min.js') }}"></script>
        <script>
            let weekProg = JSON.parse(document.querySelector('.hidden').innerHTML)
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    allDaySlot: false,
                    headerToolbar: {
                        right: '',
                        left: ''
                    },
                    displayEventTime: false,
                    slotMinTime: '08:00',
                    slotMaxTime: '20:00',
                    events: weekProg,
                });

                calendar.render();
            });
        </script>
        <script>
            function plus_time() {
                let newTime = document.querySelector(".time-template").children[0].cloneNode(true)
                newTime.style.display = 'block'
                document.querySelector("#time-wrapper").appendChild(newTime)
            }

            function delete_time(inp) {
                inp.parentNode.parentNode.parentNode.remove();
            }
        </script>
        <script>
            $('.ui.dropdown').dropdown();
        </script>
    @endpush
@endsection

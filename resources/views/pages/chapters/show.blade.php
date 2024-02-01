@extends('layouts.master')
@section('content')
    {{-- **************** Subject's Lectures **************** --}}
    <div class="container-fluid">
        <div class="row text-center p-1">
            <div class="col-md-2 p-1">
                <a href={{ route('packages.show', $subject->package) }} title="{{ $subject->package->name }} subjects"
                    class="md-btn md-raised mt-1 mb-2 p-1 primary text-white r-15"><i class="fas fa-long-arrow-left"></i>
                    {{ $subject->package->name }} subjects
                </a>                
                <div class="p-2 primary-light b-a b-primary b-2x mt-3 ">
                    <div>
                        <img src="{{ asset('storage/images/packages/' . $subject->package->image) }}"
                            alt={{ asset('storage/images/packges/' . $subject->package->image) }} width="100%" height="130">
                    </div>

                    <div class="text-md mt-1">
                        <div class="text-primary  _800">
                            {{ $subject->package->name }} </div>
                        {{ $subject->package->start_date }} <br>
                        {{ $subject->package->end_date }}
                        <div class="text-primary  _800">
                            {{ $subject->name }}
                        </div>
                    </div>  
                </div>
            </div>
            {{-- **************** for lectures **************** --}}
            <div class="col-md-10  p-0">
                <div class="container box-header">
                    <div class="box-header text-primary ">
                        <h2 class="d-inline ml-2">{{ $subject->name }}’s lectures ({{ $subject->lectures->count() }})</h2>
                    </div>  
                    <div class="row box p-3 b-a">
                        <div class="col-md-7  mx-auto">
                            <form method="get" action="{{ route('lectures.create') }}">
                                <div class="b-a b-3x  p-2  ">
                                    <div class="text-primary position-relative z-1 bg-white w-md mx-auto text-lg"
                                        style="bottom:20px">Adding lecture </div>
                                    <div class="text-md">Choose Time then Add lecture</div>
                                    <select name="week_program_id" id="" class="form-control d-inline w-md">
                                        @foreach ($subject->weekProgs as $weekProg)
                                            <option value="{{ $weekProg->id }}">{{ $weekProg->day }} -
                                                {{ date('h:i', strtotime($weekProg->start_time)) }} -
                                                {{ date('h:i', strtotime($weekProg->end_time)) }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <button class="md-btn md-raised primary text-white w-md ml-2 mt-2"> Add
                                        Lecture &nbsp;&nbsp;&nbsp; <i class="fas fa-plus-square fa-lg"></i> </button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped  b-a b-3x no-wrap">
                                <thead class="dker">
                                    <tr>
                                        <th>Name</th>
                                        <th>date</th>
                                        <th class="w-sm">video link</th>
                                        <th> day-time</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lectures as $lecture)
                                        <tr>
                                            <td>{{ $lecture->name }}</td>
                                            <td>{{ $lecture->date }}</td>
                                            <td><a class="text-primary" href="{{ $lecture->video_link }}">   {{ $lecture->video_link }}</a></td>
                                            <td class="w-sm">{{ $lecture->weekProg->day }} <br />
                                                [{{ date('h:i', strtotime($lecture->weekProg->start_time)) . '-' . date('h:i', strtotime($lecture->weekProg->end_time)) }}]
                                            </td>
                                            <td class="">
                                                <a class="btn btn-sm btn-outline-info border-0" title="edit"
                                                    onclick="alert('under working')"
                                                    href="{{ route('lectures.edit', $lecture) }}" target="_blank">
                                                    <i class="fa fa-edit"></i></a>
                                                <form action="{{ route('lectures.destroy', ['lecture' => $lecture]) }}"
                                                    method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Delete {{ $lecture->name }} Lecture?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-outline-danger border-0" title="delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="w-sm">
                                                <a title="lectures" class="md-btn md-raised primary text-white w-sm r-15"
                                                    href="{{ route('lectures.show', ['lecture' => $lecture]) }}"> pdf
                                                    files <i class="fas fa-long-arrow-right"></i></a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>



    <script>
        const startTime = document.getElementById('start_time');
        const endTime = document.getElementById('end_time');
        const submitBtn = document.getElementById('submit-btn');
        document.getElementById('myForm').addEventListener('submit', function(event) {
            // Prevent form submission
            event.preventDefault();
            const startTimeVal = new Date("2023-01-01 " + startTime.value);
            const endTimeVal = new Date("2023-01-01 " + endTime.value);

            var starttimestamp = startTimeVal.getTime();
            var endtimestamp = endTimeVal.getTime();
            // Check condition
            if (endtimestamp < starttimestamp) {
                // Display error message
                alert('Your error message here');
            } else {
                // Submit form
                this.submit();
            }
        });
    </script>
    <!-- ############ PAGE END-->
@endsection

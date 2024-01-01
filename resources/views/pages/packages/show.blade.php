@extends('layouts.master')
@section('content')
    {{-- ***************************  package's subjects ************************** --}}
    <div class="container-fluid">
        <div class="row text-center align-items-start">
            <div class="col-md-2 ">
                <a href="{{ route('packages.index') }}" title="All packages"
                    class="md-btn md-raised m-b-sm primary text-white r-15 mt-3 w-135"><i class="fas fa-long-arrow-left"></i>
                    All packages</a>

                <div class="p-2 b-a b-primary b-2x text-center bg-white ">
                    <div>
                        @if($package->image)
                        <img src="{{ asset( 'storage/images/packages/' . $package->image) }}"
                             width="100%" height="130px">
                        @else
                        <img src="{{   asset('storage/images/packages/no-image.png') }}"
                            width="100%" height="130px">
                        @endif
                    </div>
                    <div class="p-2 text mt-1">
                        <div class=" _800">
                            <div class="text-primary">package Name: </div>
                            {{ $package->name }}
                        </div>
                        <div class="text-primary text _800">Starts at:  
                            <div class="text-dark _100 " >{{ $package->start_date }}</div>
                        </div>
                        <div class="text-primary text _800">Ends at:
                            <div class="text-dark _100 ">{{ $package->end_date }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 ">
                <div class="box-header text-primary">
                    <h2 class="d-inline ml-2">{{ $package->name }}’s subjects ({{ $package->subjects->count() }})</h2>
                </div>
                <div class="box">
                    <div class="table-responsive p-2 text-left">
                        
                        <a class="md-btn md-raised primary text-white w-md m-3"
                            href="{{ route('subjects.create', ['package' => $package->id]) }}"><i class="fas fa-plus-square fa-lg"></i> &emsp; Add subject
                            </a>
                        <table class="table table-striped b-a b-2x text-center no-wrap">
                            <thead class="dker text-primary">
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Subject Cost</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($package->subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->cost }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-success border-0" title="students"
                                                href="{{ route('students.index', ['subject' => $subject]) }}">
                                                <i class="fa fa-users"></i></a>
                                            <a class="btn btn-sm btn-outline-warning border-0" title="notify"
                                                href="{{ route('notifications.create', ['subject' => $subject]) }}">
                                                <i class="fa fa-bell"></i></a>
                                            <a class="btn btn-sm btn-outline-info border-0" title="edit"
                                                href="{{ route('subjects.edit', $subject) }}">
                                                <i class="fa fa-edit"></i></a>
                                            <form action="{{ route('subjects.destroy', ['subject' => $subject]) }}"
                                                method="POST" class="d-inline pl-1"
                                                onsubmit="return confirm('Delete {{ $subject->name }} Subject?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger border-0" title="delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>                                    
                                            <a class="btn btn-sm btn-outline-success border-0"  title="excel"
                                                href="{{ route('subjects.excel', $subject) }}">
                                                <i class="fa fa-table"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a title="Lectures" class="md-btn md-raised primary text-white w-sm r-15"
                                                href="{{ route('subjects.show', ['subject' => $subject]) }}"> Lectures <i
                                                    class="fas fa-long-arrow-right"></i></a>
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

    <br>
    <br>
    <br>
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

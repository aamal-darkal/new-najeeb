@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2 box p-2 ">
            <div class="box-header">
                <a class="md-btn md-raised primary text-white m-0" href="{{ route('students.index' , ['state' => $student->state]) }}"><i
                        class="fas fa-long-arrow-left"></i></a>

                <h2 class="text-primary d-inline ml-2 text-2x"> Student info: {{ $student->first_name }}
                    {{ $student->father_name }}
                    {{ $student->last_name }} </h2>
            </div>
        </div>
        <div class="container">
            <div class=" col-md-8 offset-md-2 box p-2 text-center">
                <a href="{{ route('students.password-edit', $student) }}" class="md-btn md-raised w-sm accent py-1 mt-1">
                    edit
                    password</a>
                <a href="{{ route('students.edit', $student) }}" class="md-btn md-raised w-sm py-1 primary mt-1">Edit
                    data</a>
                <a href="{{ route('students.subcribe-create', $student) }}"
                    class="md-btn md-raised w-sm py-1 info mt-1">subcribe</a>
                <a href="{{ route('notifications.create', ['student' => $student]) }}"
                    class="md-btn md-raised w-sm py-1 warn mt-1">notify</a>
                <form action="{{ route('students.destroy', ['student' => $student]) }}" class="d-inline" method="post"
                    onsubmit="return confirm('delete student ?')">
                    @csrf
                    @method('delete')
                    <button class="md-btn md-raised w-sm py-1 warning position-relative mt-3"
                        style="bottom:10px">Delete</button>
                </form>
            </div>
        </div>

        {{-- ********************* user info ********************** --}}
        <div class="container">
            <div class="col-md-8 offset-md-2 box p-2 ">
                <div class="row">
                    <div class="col-5">
                        <div class="text-primary p-1">Username: </div>
                        <div class="field-value bg-white p-1 box-shadow">{{ $student->user->user_name }}</div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-5">
                        <div class="text-primary p-1 ">First name:</div>
                        <div class="field-value bg-white p-1 box-shadow"> {{ $student->first_name }} </div>
                    </div>

                    <div class="col-5">
                        <div class="text-primary p-1">Last name: </div>
                        <div class="field-value bg-white p-1 box-shadow">{{ $student->last_name }}</div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-5">
                        <div class="text-primary p-1">Fathor name:</div>
                        <div class="field-value bg-white p-1 box-shadow ">{{ $student->father_name }}</div>
                    </div>

                    <div class="col-5">
                        <div class="text-primary p-1">governorate</div>
                        <div class="field-value bg-white p-1 box-shadow ">{{ $student->governorate }}</div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-5">
                        <div class="text-primary p-1">phone</div>
                        <div class="field-value bg-white p-1 box-shadow ">{{ $student->phone }}</div>
                    </div>

                    <div class="col-5">
                        <div class="text-primary p-1">parent phone </div>
                        <div class="field-value bg-white p-1 box-shadow ">{{ $student->parent_phone }}</div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-5">
                        <div class="text-primary p-1">land line:</div>
                        <div class="field-value bg-white p-1 box-shadow ">{{ $student->land_line }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- subjects --}}
        @if ($student->subjects->count())
            <div class="container">
                <div class="col-md-8 offset-md-2 box p-2">
                    <div class="box-header text-primary">
                        <h2> Subjects </h2>
                    </div>
                    @php
                        $student_id = $student->id;
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed text-center">
                            <thead class="dker text-dark">
                                <tr>
                                    <th>name</th>
                                    <th>cost</th>
                                    <th>package</th>
                                    <th>subcription date</th>
                                    <th>Attendence rate </th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student->subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->cost }}</td>
                                        <td>{{ $subject->package->name }}</td>
                                        <td>{{ \Carbon\Carbon::create($subject->pivot->created_at)->diffForHumans() }}</td>
                                        <td>
                                            @if ($subject->lectures->count() > 0)
                                                {{ round(
                                                    ($subject->lectures()->whereHas('students', function ($q) use ($student_id) {
                                                            return $q->where('student_id', $student_id);
                                                        })->count() /
                                                        $subject->lectures->count()) *
                                                        100,
                                                    0,
                                                ) }}%
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('students.subcribe-destroy', $student) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                                <button
                                                    class="btn btn-outline-primary p-0 pl-1 pr-1 md-raised">unsubcribe</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        {{-- orders --}}
        @if ($student->orders->count())
            <div class="container">
                <div class="box col-md-8 p-2 mt-2 offset-md-2">
                    <div class="box-header text-primary">
                        <h2> Orders </h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed text-center">

                            <thead class="dker text-dark">
                                <tr>
                                    <th>amount</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($student->orders as $order)
                                    <tr>
                                        <td>{{ $order->amount }}</td>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- payments --}}
            <div class="container">
                <div class="box p-2 col-md-8 p-2 mt-2 offset-md-2">
                    <div class="box-header text-primary">
                        <h2> Payments </h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed text-center">
                            <thead class="dker text-dark">
                                <tr>
                                    <th>amount</th>
                                    <th>bill_number</th>
                                    <th>payment_date</th>
                                    <th>payment_method</th>
                                    <th>state</th>
                                    <th>start_duration_date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($student->orders as $order)
                                    @foreach ($order->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ $payment->bill_number }}</td>
                                            <td>{{ $payment->payment_date }}</td>
                                            <td>{{ $payment->paymentMethod->name }}</td>
                                            <td>{{ $payment->state }}</td>
                                            <td>{{ $payment->start_duration_date }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($student->notifications->count())
            <div class="container">
                <div class="box col-md-8 p-2 mt-2 offset-md-2">
                    <div class="box-header text-primary">
                        <h2> Notications </h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed text-center">
                            <thead class="dker text-dark">
                                <tr>
                                    <th>title</th>
                                    <th>description</th>
                                    <th>time_publish</th>
                                    <th>seen</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($student->notifications()->orderby('time_publish' , 'desc')->get() as $notification)
                                    <tr>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ $notification->description }}</td>
                                        <td>{{ $notification->time_publish }}</td>
                                        <td>{{ $notification->pivot->seen }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif


    @endsection

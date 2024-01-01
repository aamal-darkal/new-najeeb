@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2 class="text-primary">Subscriptions - All</h2>
            </div>
            <div>
                @if ($payments->isNotEmpty())
                    @csrf
                    <div class="table-responsive">

                        <table class="table table-striped b-t b-b">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Student</th>
                                    <th>Bill number</th>
                                    <th>Payed amount</th>
                                    <th>Ordered at</th>
                                    <th>Status</th>
                                    <th>subjects</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td></td>
                                        <td>{{ $payment->order->student->first_name }}
                                            {{ $payment->order->student->father_name }}
                                            {{ $payment->order->student->last_name }}</td>
                                        <td>{{ $payment->bill_number }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ \Carbon\Carbon::create($payment->payment_date)->diffForHumans() }}</td>
                                        @if ($payment->state == 'approved')
                                            <td><span class="label success" title="approved">{{ $payment->state }}</span>
                                            </td>
                                        @elseif($payment->state == 'rejected')
                                            <td><span class="label danger" title="rejected">{{ $payment->state }}</span>
                                            </td>
                                        @elseif($payment->state == 'pending')
                                            <td><span class="label warn" title="pending">{{ $payment->state }}</span>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn white dropdown-toggle"
                                                    data-toggle="dropdown">{{ $payment->order->subjects_count }}</button>
                                                <div class="dropdown-menu dropdown-menu-scale">
                                                    <ul class="timeline">
                                                        @foreach ($payment->order->subjects as $subject)
                                                            <li class="tl-item">
                                                                <div class="tl-wrap b-primary"
                                                                    style="margin-left: 10px; padding: 4px 0px 4px 20px">
                                                                    <div class="tl-content text-center">
                                                                        {{ $subject->name }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="container w-75 text-center">
                        <img src="{{ asset('images/defaults/no-data.png') }}" alt="" class="w-50">

                        <p class="h4 text-primary">There is no pending subscriptions</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ############ PAGE END-->


@endsection

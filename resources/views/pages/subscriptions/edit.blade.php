@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header text-primary text-capitalize">
                <h2>Subscriptions - {{ $status }}</h2>
            </div>
            @if ($payments->isNotEmpty())
                <form method="POST" action="{{ route('subscriptions.update') }}" onsubmit="return checkSelection()">
                    @csrf
                    <div class="responsive">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> <button type="button" class="btn primary p-1 m-0 text-xs" id="checkStatus"
                                            onclick="checkAllRecords()">Check All</button>
                                    </th>
                                    <th>Student</th>
                                    <th>Bill number</th>
                                    <th>Payed amount</th>
                                    <th>Ordered at</th>
                                    <th>subjects</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td class="text-center"><label class="ui-check m-0"><input type="checkbox"
                                                    name="ids[]" value="{{ $payment->id }}"><i
                                                    style="background-color: #f1efef"></i></label>
                                        </td>
                                        <td>{{ $payment->order->student->first_name }}
                                            {{ $payment->order->student->father_name }}
                                            {{ $payment->order->student->last_name }}</td>
                                        <td>{{ $payment->bill_number }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ \Carbon\Carbon::create($payment->payment_date)->diffForHumans() }}</td>
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
                                                                        {{ $subject->package->name }} -
                                                                        {{ $subject->name }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="no-wrap">
                                            @if ($status == 'pending')
                                                <button type="submit" name="action" value="approve"
                                                    class="md-btn md-raised w-xs primary m-1 p-0"
                                                    onclick="document.querySelector('[type=\'checkbox\'][value=\'{{ $payment->id }}\']').checked=true">
                                                    Approve</button>
                                                <button type="submit" name="action" value="reject"
                                                    class="md-btn md-raised w-xs danger m-1 p-0"
                                                    onclick="return confirmReject({{ $payment->id }})">
                                                    Reject</button>
                                            @elseif ($status == 'approved')
                                                <button type="submit" name="action" value="unapprove"
                                                    class="md-btn md-raised w-sm btn-outline-danger p-0"
                                                    onclick="document.querySelector('[type=\'checkbox\'][value=\'{{ $payment->id }}\']').checked=true">
                                                    Unapprove</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        @if ($status == 'pending')
                            <button type="submit" name="action" value="approve"
                                class="md-btn md-raised w-sm primary m-4 p-1">
                                many Approve</button>
                            <button type="submit" name="action" value="reject"
                                onclick="return confirm('delete subscription?')"
                                class="md-btn md-raised w-sm danger m-4  p-2">
                                many Reject</button>
                        @elseif ($status == 'approved')
                            <button type="submit" name="action" value="unapprove"
                                class="md-btn md-raised w-md btn-outline-danger m-4 p-1">
                                many Unapprove</button>
                        @endif
                    </div>
                </form>
            @else
                <div class="container w-75 text-center">
                    <img src="{{ asset('images/defaults/no-data.png') }}" alt="" class="w-50">
                    <p class="h4 text-primary">There is no pending subscriptions</p>
                </div>
            @endif
        </div>
    </div>
    <script>
        function confirmReject(payment) {
            let result = confirm('delete subscription?')
            if (!result) return false
            document.querySelector(`[type='checkbox'][value='${payment}']`).checked = true
            return true
        }

        function checkSelection() {
            let anySelected = document.querySelector("input[type='checkbox']:checked");
            if (!anySelected) {
                alert("you should select row")
                return false
            }
        }

        function checkAllRecords() {
            var checkboxes = document.getElementsByName("ids[]");
            var checkStatus = document.getElementById("checkStatus").innerHTML;
            if (checkStatus === 'Check All') {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                }
                document.getElementById("checkStatus").innerHTML = 'Uncheck All';
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
                document.getElementById("checkStatus").innerHTML = 'Check All';

            }
        }
    </script>


@endsection

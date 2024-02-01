@extends('layouts.master')
@section('content')

    <div class="container">
        @if ($group != 'All')
            <a onclick="history.back()" title="back" class="md-btn md-raised m-b-sm primary text-white mt-2 ml-2 "><i
                    class="fas fa-long-arrow-left"></i></a>
        @endif
        {{-- ***************************** search form *********************** --}}
        <div class="row">
            @if (isset($search))
                <div class="col-md-2 p-0 mt-2">
                    <button type="button" class="md-btn md-raised w-100 h-100 primary"
                        onclick="location='{{ route('students.index', ['state' => $state]) }}'">
                        All {{ $state }} students
                    </button>
                </div>
            @endif
            <div class="col mt-2">
                <form action="{{ route('students.search', $group) }}" method="get" class="h-100">
                    <div class="row">
                        <input type="hidden" name="state" value="{{ $state }}">
                        <input type="text" class="form-control col-10" name="search" placeholder="Type keyword">
                        <button class="md-btn md-raised w-sm primary col-2" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ********************************* header ************************* --}}
    <div class="container p-1 mt-2 box">
        <div class="box-header">

            @if (isset($search))
                <h2 class="text-primary"> Search Result (in {{ $state }} students) for: {{ $search }} </h2>
            @elseif (isset($state))
                <h2 class="text-primary"> {{ $group }} {{ $state }} Students </h2>
            @endif

            @if ($students->isNotEmpty())
                {{ $students->appends(request()->except('page'))->links() }}.
            @endif
        </div>

        <div class="mt-2">
            @if ($students->isNotEmpty())
                <div>
                    @foreach ($errors->all() as $error)
                        <p> {{ $error }}</p>
                    @endforeach
                </div>

                <form method="POST" action="{{ route('students.update-many') }}" onsubmit="return checkSelection()" class="mb-5">
                    @csrf
                    <div class="responsive">
                        <table class="table table-striped text-center table-bordered table-condensed no-wrap">
                            <thead>
                                <tr class="l-h-2x primary-light">
                                    <th class="w-96"> <button type="button"
                                            class="btn w-xs px-1 py-0 m-0 text-xs _800 r-15" id="checkStatus"
                                            onclick="checkAllRecords()">Check All</button>
                                    </th>                                    
                                    <th>mobile</th>
                                    <th>full name</th>
                                    <th>start At</th>
                                    <th>Assigned subjects</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="text-center"><label class="ui-check m-0"><input type="checkbox"
                                                    name="ids[]" value="{{ $student->id }}"><i
                                                    style="background-color: #f1efef"></i></label>
                                        </td>
                                        <td>{{ $student->user->mobile }}</td>
                                        <td>{{ $student->first_name }} {{ $student->father_name }}
                                            {{ $student->last_name }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::create($student->created_at)->diffForHumans() }}</td>


                                        <td class="text-center">
                                            {{-- <div class="btn-group dropdown">
                                                <button class="btn white dropdown-toggle"
                                                    data-toggle="dropdown">{{ $student->subjects_count }}</button>
                                                <div class="dropdown-menu dropdown-menu-scale">
                                                    <ul class="timeline">
                                                        @foreach ($student->subjects as $subject)
                                                            <li class="tl-item">
                                                                <div class="tl-wrap b-primary"
                                                                    style="margin-left: 10px; padding: 4px 0px 4px 20px">
                                                                    <div class="tl-content text-center">
                                                                        {{ $subject->name }}
                                                                        @php $student_id = $student->id; @endphp
                                                                        @if ($subject->lectures->count() > 0)
                                                                            %{{ round(
                                                                                ($subject->lectures()->whereHas('students', function ($q) use ($student_id) {
                                                                                        return $q->where('student_id', $student_id);
                                                                                    })->count() /
                                                                                    $subject->lectures->count()) *
                                                                                    100,
                                                                                0,
                                                                            ) }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div> --}}
                                        </td>
                                        <td>
                                            @if ($state == 'current')
                                                <button type="submit" name="action" value="reset-token"
                                                    class="btn btn-sm text-warn bg-transparent" title="Reset token"
                                                    onclick="document.querySelector('[type=\'checkbox\'][value=\'{{ $student->id }}\']').checked=true">
                                                    <i class="fa fa-refresh"></i>
                                                </button>
                                                <button type="submit" name="action" value="ban"
                                                    class="btn btn-sm text-danger bg-transparent" title="ban"
                                                    onclick="document.querySelector('[type=\'checkbox\'][value=\'{{ $student->id }}\']').checked=true">
                                                    <i class="fa fa-ban"></i>
                                                </button>
                                            @elseif($state == 'banned')
                                                <button type="submit" name="action" value="unban"
                                                    class="btn btn-sm text-info bg-transparent" title="unban"
                                                    onclick="document.querySelector('[type=\'checkbox\'][value=\'{{ $student->id }}\']').checked=true">
                                                    <i class="fa fa-unlock"></i>
                                                </button>
                                            @endif

                                            <a href="{{ route('students.show', $student) }}"
                                                class="btn btn-sm text-md text-primary border-0 bg-transparent"
                                                title="Details">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        @if ($state == 'current')
                            <button type="submit" name="action" value="reset-token"
                                class="btn btn-outline-warning btn-xs  _800 w-160  mx-2 mb-3 r-15">
                                <i class="fa fa-refresh"></i> Many Reset Token
                            </button>

                            <button type="submit" name="action" value="ban"
                                class="btn btn-xs btn-outline-danger w _800 mb-3 r-15">
                                <i class="fa fa-ban"></i> Many Ban
                            </button>
                        @elseif($state == 'banned')
                            <button type="submit" name="action" value="unban"
                                class="btn btn-sm text-info btn-raise mb-3 r-15"
                                onclick="document.querySelector('[type=\'checkbox\'][value=\'{{ $student->id }}\']').checked=true">
                                <i class="fa fa-unlock"></i> Many Unban
                            </button>
                        @endif

                    </div>
                </form>
            @else
                <div class="container w-75">
                    <div class="text-center">
                        @if (isset($search))
                            <p class="h4 text-primary">There is no name such as "{{ $search }}"</p>
                        @elseif (isset($state))
                            <p class="h4 text-primary">There is no students</p>
                        @endif
                        <img src="{{ asset('images/defaults/no-data.png') }}" alt="" class="w-50">
                    </div>
                </div>
            @endif
        </div>

        <script>
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

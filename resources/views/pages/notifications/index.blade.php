@extends('layouts.master')
@section('content')
{{-- ***************************  packages ************************** --}}
    <div class="padding">
        <div class="box col-md-10 offset-md-1">

            <div class="box-header text-primary d-flex justify-content-between">
                <h2>All Notifications</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-a b-2x text-center no-wrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Time publish</th>
                            <th>Created at</th>
                            <th>Student count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td></td>
                                <td>{{ $notification->title }}</td>
                                <td class="text-right">{{ $notification->description }}</td>
                                <td>{{ $notification->time_publish }}</td>
                                <td>{{ $notification->created_at }}</td>
                                <td>{{ $notification->students_count }}</td>
                                <td class="w-md">
                                    
                                    <a class="btn btn-sm btn-outline-success border-0" title="students" href="{{ route('students.index',  ['notification' => $notification]  ) }}">
                                        <i class="fa fa-users"></i></a>
                                    
                                    <a class="btn btn-sm btn-outline-info border-0" title="edit" href="{{ route('notifications.edit', $notification) }}">
                                        <i class="fa fa-edit"></i></a>
                                    <form action="{{ route('notifications.destroy', ['notification' => $notification]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $notification->name }} notification?')" >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger border-0" title="delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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

    <!-- ############ PAGE END-->
@endsection

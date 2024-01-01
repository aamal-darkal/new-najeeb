@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">

            <div class="box-header">
                <h2>Subjects</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-b    ">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Cost</th>
                            <th>Created at</th>
                            <th>Assigned students</th>
                            <th class="text-center" style="width:15%">package</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td></td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->cost }}</td>
                                <td>{{ $subject->created_at }}</td>
                                <td class="text-center">{{ $subject->students_count }}</td>
                                @if ($subject->package)
                                    <td class="text-center text-primary pos-rlt bold" >
                                            {{ $subject->package->name }}
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td class="text-center">
                                    <form action="{{ route('subjects.destroy', ['subject' => $subject]) }}" method="POST">
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


    <!-- ############ PAGE END-->
@endsection

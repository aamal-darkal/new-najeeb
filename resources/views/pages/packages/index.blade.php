@extends('layouts.master')
@section('content')
    {{-- ***************************  packages ************************** --}}
    <div class="padding">
        <h2 class="text-primary text-center">All Packages</h2> <br>

        <div class="box col-md-10 offset-md-1">
            <div class="box-header">
                <a class="md-btn md-raised primary text-white w-md" href="{{ route('packages.create') }}">Add package
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-square fa-lg"></i></a></a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-a b-2x text-center no-wrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="w-sm">Name</th>
                            <th>Starts at</th>
                            <th>Ends at</th>
                            <th>Subjects count</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td></td>
                                <td class="w-sm">{{ $package->name }}</td>
                                <td>{{ $package->start_date }}</td>
                                <td>{{ $package->end_date }}</td>
                                <td>{{ $package->subjects_count }}</td>
                                <td class="w-md">
                                    <a class="btn btn-sm btn-outline-success border-0" title="students"
                                        href="{{ route('students.index', ['package' => $package]) }}">
                                        <i class="fa fa-users"></i></a>
                                    <a class="btn btn-sm btn-outline-warning border-0" title="notify"
                                        href="{{ route('notifications.create', ['package' => $package]) }}">
                                        <i class="fa fa-bell"></i></a>
                                    <a class="btn btn-sm btn-outline-info border-0" title="edit"
                                        href="{{ route('packages.edit', $package) }}">
                                        <i class="fa fa-edit"></i></a>
                                    {{-- <form action="{{ route('packages.destroy', ['package' => $package]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $package->name }} Package?')" > --}}
                                    <form action="{{ route('packages.destroy', ['package' => $package]) }}" id="deletePkg"  method="POST"
                                        class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-sm btn-outline-danger border-0" title="delete" onclick="confirmMsg()">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center w-sm">
                                    <a title="Subjects" class="md-btn md-raised primary text-white w-sm r-15"
                                        href="{{ route('packages.show', ['package' => $package]) }}"> Subjects <i
                                            class="fas fa-long-arrow-right"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @push('js')
        <script>
            function confirmMsg() {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            document.querySelector('#deletePkg').submit()
                        } else {
                            null;;
                        }
                    });
            }
        </script>
    @endpush
@endsection

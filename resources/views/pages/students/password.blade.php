@extends('layouts.master')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
    @endpush
    <!-- ############ PAGE START-->
    <div class="padding">

        <div class="box col-md-6 offset-md-3">
            <div class="box-header">
                <a class="md-btn md-raised primary text-white m-0"
                    href="{{ route('students.show', $student) }}"><i class="fas fa-long-arrow-left"></i></a>
                <h2 class="text-primary text-2x d-inline ml-2"> Change Password</h2>
            </div>
            <div class="box-divider m-0"></div>

            <div class="box-body p-5">

                <form role="form" method="POST" action="{{ route('students.password-update', $student) }}">
                    @csrf
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="text" class="form-control" placeholder="Enter new password" name="password"
                            required>
                        <div class="text-danger">

                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn primary m-b">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    @endpush

    @push('js')
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    @endpush
@endsection

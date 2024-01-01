@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header text-primary">
                    <a class="md-btn md-raised primary text-white" onclick="history.back()"><i
                            class="fas fa-long-arrow-left"></i></a>
                    <h2 class="d-inline ml-2">Add new package</h2>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <form role="form" method="POST" action="{{ route('packages.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter package name"
                                name="name" value="{{ old('name') }}" required maxlength="100">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image: </label>
                            <div class="form-control text-center">
                                <div class="mx-auto w-md mb-2">
                                    <img class="w-100" id="imgPreview"
                                        src="{{ asset('storage/images/packages/no-image.png') }}">
                                </div>
                                <input type="file" id="image" name="image" accept="image/*">
                            </div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="start_date">Starts at</label>
                            <div id='start_date'>
                                <input type='date' class="form-control" name="start_date"  value="{{ old('start_date') }}" required />
                                @error('start_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_date">Ends at</label>
                            <div id='end_date'>
                                <input type='date' class="form-control" name="end_date"  value="{{ old('end_date') }}" required />                              @error('end_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn white m-b primary">Save Package</button>
                    </form>
                </div>
            </div>
        </div>
        @push('js')
            <script>
                $('#start_date').datetimepicker();
                $('#end_date').datetimepicker();
            </script>
        
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script>
            $(document).ready(() => {
                $('#image').change(function() {
                    const file = this.files[0];
                    console.log(file);
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            console.log(event.target.result);
                            $('#imgPreview').attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    @endpush

@endsection

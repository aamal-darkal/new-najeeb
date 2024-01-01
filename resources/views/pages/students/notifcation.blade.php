@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="container padding">
        <div class="box col-md-6 offset-md-3">  
            <div class="box">
                <div class="box-header">
                    <a class="md-btn md-raised primary text-white m-0"
                    href="{{ route('students.show', $student) }}"><i class="fas fa-long-arrow-left"></i></a>
                    <h2 class="text-primary text-2x d-inline ml-2">Send notification to {{ $student->first_name }} {{ $student->father_name }}
                        {{ $student->last_name }}</h2>                        
                </div>

                <div class="box-divider"></div>
                <form role="form" method="POST" action="{{ route('students.notification-store' ,  $student) }}" class="container mt-2">
                    @csrf
                       
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" placeholder="Enter notification title" id="title"
                            id="title" name="title" value="{{ old('title') }}" required>
                        <div class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Content</label>
                        <input type="text" class="form-control" placeholder="Enter notification content" id="description"
                            id="description" name="description" value="{{ old('description') }}" required>
                        <div class="text-danger">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="time_publish">Publish Time</label>
                        <input type='text' class="form-control datetimepicker" name="time_publish" id="time_publish"
                            required autocomplete="off">
                        <div class="text-danger">
                            @error('time_publish')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn white m-b m-t primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".datetimepicker").each(function() {
            $(this).datetimepicker();
        });
    </script>

    <script>
        $('.ui.dropdown').dropdown();
    </script>
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
    @endpush

    @push('js')
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
        <!-- datetimepicker jQuery CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
        </script>
    @endpush
    <!-- ############ PAGE END-->
@endsection

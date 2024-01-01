@extends('layouts.master')
@section('content')
    <div class="container padding ">
        <div class="box col-md-6 offset-md-3">
            <div class="box-header text-primary">
                <a class="md-btn md-raised primary text-white m-0"
                    onclick="history.back()"><i class="fas fa-long-arrow-left"></i></a>
                <h2 class="inline ml-2">Edit notification </h2>
            </div>      
            <div>
                @foreach ($errors->all() as $error)
                    <p> {{ $error }}</p>
                @endforeach
            </div>
            <div class="box-divider"></div>
            <form role="form" method="POST" action="{{ route('notifications.update' , $notification) }}" class="container mt-2">
                @csrf
               @method('put')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" placeholder="Enter notification title" id="title"
                        id="title" name="title" value="{{ old('title' , $notification->title) }}" required>
                    <div class="text-danger">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Content</label>
                    <input type="text" class="form-control" placeholder="Enter notification content" id="description"
                        id="description" name="description" value="{{ old('description' , $notification->description) }}" required>
                    <div class="text-danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="time_publish">Publish Time</label>
                    <input type='text' class="form-control datetimepicker" name="time_publish" id="time_publish" value="{{ old('time_publish' , $notification->time_publish) }}" required
                        autocomplete="off">
                    <div class="text-danger">
                        @error('time_publish')
                            {{ $message }}
                        @enderror
                    </div>
                </div>


                <button type="submit" class="btn white m-b m-t primary">Submit</button>
            </form>
        </div>

        <script type="text/javascript">
            $(".datetimepicker").each(function() {
                $(this).datetimepicker();
            });
        </script>

        @push('css')
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
        @endpush

        @push('js')
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <!-- datetimepicker jQuery CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
            </script>
        @endpush
        <!-- ############ PAGE END-->
    @endsection

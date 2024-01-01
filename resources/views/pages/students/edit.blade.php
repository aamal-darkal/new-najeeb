@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box col-md-6 offset-md-3">
            <div class="box-header">
                <a class="md-btn md-raised primary text-white m-0" href="{{ route('students.show', $student) }}"><i
                        class="fas fa-long-arrow-left"></i></a>
                <h2 class="text-primary text-2x d-inline ml-2">Edit Student Data</h2>
            </div>
            <div class="box-divider m-0"></div>
            <div class="box-body">

                <form role="form" method="POST" action="{{ route('students.update', $student) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="user_name">user name</label>
                                <input type="text" id="user_name" class="form-control" name="user_name"
                                    value="{{ old('user_name', $student->user->user_name) }}" required max="50">

                                <div class="text-danger">
                                    @error('user_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="first_name">First name</label>
                                <input type="text" id="first_name" class="form-control" placeholder="Enter First name"
                                    name="first_name" value="{{ old('first_name', $student->first_name) }}" required
                                    max="50">

                                <div class="text-danger">
                                    @error('first_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <label for="last_name">Last name</label>
                                <input type="text" id="last_name" class="form-control" placeholder="Enter Last name"
                                    name="last_name" value="{{ old('last_name', $student->last_name) }}" required
                                    max="50">
                                <div class="text-danger">
                                    @error('last_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="father_name">Father name</label>
                                <input type="text" id="father_name" class="form-control" placeholder="Enter Father name"
                                    name="father_name" value="{{ old('father_name', $student->father_name) }}" required
                                    max="50">
                                <div class="text-danger">
                                    @error('father_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <label for="governorate">Governorate</label>
                                <select name="governorate" id="governorate"
                                    class="form-control ui dropdown search selection ">
                                    <option hidden selected value="">Enter governorate</option>
                                    @foreach ($governorates as $governorate)
                                        <option value="{{ $governorate }}" @selected(old('governorate', $student->governorate) == $governorate)>
                                            {{ $governorate }}</option>
                                    @endforeach
                                </select>

                                <div class="text-danger">
                                    @error('governorate')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone"
                                    value="{{ old('phone', $student->phone) }}" required minlength="10" maxlength="10"
                                    pattern="[0-9]{7,10}" title="enter valid phone">
                                <div class="text-danger">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <label for="parent_phone">Parent phone</label>
                                <input type="text" id="parent_phone" class="form-control"
                                    placeholder="Enter parent phone" name="parent_phone"
                                    value="{{ old('parent_phone', $student->parent_phone) }}" minlength="10" maxlength="10"
                                    pattern="[0-9]{10}" title="enter valid phone">
                                <div class="text-danger">
                                    @error('parent_phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col">
                            <label for="land_line">Land line</label>
                            <input type="text" id="land_line" class="form-control" placeholder="Enter land line number"
                                name="land_line" value="{{ old('land_line', $student->land_line) }}" minlength="7"
                                maxlength="10" pattern="[0-9]{7,10}" title="enter valid phone">
                            <div class="text-danger">
                                @error('land_line')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn primary m-b">Save Data</button>

            </div>


            </form>
        </div>
    </div>
    <!-- ############ PAGE END ##################### -->
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    @endpush

    @push('js')
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

        <script>
            $('.ui.dropdown').dropdown();
        </script>
    @endpush
@endsection

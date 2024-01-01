@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="box-header text-primary">
                    <a class="md-btn md-raised primary text-white" onclick="history.back()"><i
                            class="fas fa-long-arrow-left"></i></a>
                    <h2 class="d-inline ml-2">{{ $subject->package->name }} package </h2>
                </div>
                <div class="table-resposive">
                    <table class="table table-condensed text-center  b-a b-3x b-primary">
                        <thead>
                            <tr class="text-primary dker">
                                <th>image</th>
                                <th>Name</th>
                                <th>Starts at</th>
                                <th>Ends at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="primary-light _800">
                                <td><img class="w-xxs m-0"
                                        src="{{ asset('storage/images/packages/' . $subject->package->image) }}"
                                        alt={{ asset('storage/images/packges/' . $subject->package->image) }}>
                                </td>
                                <td class="v-m">{{ $subject->package->name }}</td>
                                <td class="v-m">{{ $subject->package->start_date }}</td>
                                <td class="v-m">{{ $subject->package->end_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- **************** for subject **************** --}}

                <div class="box-header text-primary mt-3">
                    <h2 class="d-inline ml-2"> {{ $subject->name }} Subject</h2>
                </div>
                <div class="table-resposive">
                    <table class="table text-center table-condensed b-a b-3x b-primary">
                        <thead>
                            <tr class="text-primary dker">
                                <th>Name</th>
                                <th>Cost</th>
                                <th class="text-center"> Lecture count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="primary-light  _800 h-sm">
                                <td class="v-m">{{ $subject->name }}</td>
                                <td class="v-m">{{ $subject->cost }}</td>
                                <td class="v-m">{{ $subject->lectures->count() }}</td>
                                <td class="v-m">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-6">
                <div class="box mt-3">
                    <div class="box-header text-primary">
                        <h2>Add new lecture</h2>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form id="myForm" method="POST" action="{{ route('lectures.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ old('week_program_id', $week_program_id) }}"
                                name="week_program_id">
                            <input type="hidden" value="{{ old('subject', $subject->id) }}" name="subject_id">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" placeholder="Enter name"
                                    name="name" value="{{ old('name') }}" required>
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="duration">Duration - by minutes</label>
                                <input type="number" class="form-control" name="duration" value="{{ old('duration') }}"
                                    required>
                                <div class="text-danger">
                                    @error('duration')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="video_link">Video link</label>
                                <input type="url" class="form-control" placeholder="Enter video link" name="video_link"
                                    value="{{ old('video_link') }}" required>
                                <div class="text-danger">
                                    @error('video_link')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pdf_files">Pdf file (hold ctrl key - choose many files )</label>
                                <input type="file" multiple class="form-control" placeholder="Upload pdf file"
                                    id="pdf_files" name="pdf_files[]" value="{{ old('pdf_files') }}" accept=".pdf">
                                <div class="text-danger">
                                    @error('pdf_files')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            {{-- <div id="extraInput" class="form-group hidden">
                            <label for="exampleInputEmail1">Pdf file Name</label>
                            <input type="text" class="form-control" placeholder="Enter pdf file name" id="pdf_file_name" name="pdf_file_name">
                        </div> --}}

                            <div class="form-group">
                                <label for="date">Date - <span class="text-primary">Only {{ $allowedDayName }}</span> </label>
                                <div id="date" class='input-group date' ui-jp="datetimepicker"
                                    ui-options="{ 
                                        daysOfWeekDisabled: {{ $denyDays }},
                                        format: 'D-M-YYYY',
                                        allowInputToggle: true 
                                    }">
                                    <input type='text' class="form-control" name="date" value="{{ old('date') }}"
                                        required />
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>

                                <div class="text-danger">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class='text-center'><button type="submit"
                                    class="md-btn md-raised m-b-sm w-lg primary text-white r-15">Save Lecture</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   

    @push('js')
     
        <script>
            document.getElementById('myForm').addEventListener('submit', function(event) {
                var fileInput = document.getElementById('pdf_file');
                var file = fileInput.files[0];

                if (file && file.type !== 'application/pdf') {
                    event.preventDefault(); // Prevent form submission
                    document.getElementById('pdfFileError').style.display = 'block';
                }
            });

            document.getElementById("pdf_file").addEventListener("change", function() {
                // Get the file input element and check if a file is selected
                var fileInput = document.getElementById("pdf_file");
                if (fileInput.files.length > 0) {
                    // Show the extra input field
                    document.getElementById("extraInput").classList.remove("hidden");
                    document.getElementById("pdf_file_name").setAttribute('required', 'required');
                } else {
                    // Hide the extra input field
                    document.getElementById("extraInput").classList.add("hidden");
                }
            });
        </script>
    @endpush
@endsection

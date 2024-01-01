@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <a class="md-btn md-raised primary text-white" onclick="history.back()"><i class="fas fa-long-arrow-left"></i></a>
        <h2 class="text-primary d-inline ms-3 mb-2">Lecture</h2>
        <div class="row">
            <div class="col">
                <div class="box p-a">                    
                    <div class="text-center text-md m-b h-2x _800">{{ $lecture->name }}</div>
                    <p class="text-center _800">Date : {{ $lecture->date }}</p>
                    <p class="text-center _800">Duration : {{ $lecture->duration }}</p>
                    <p class="text-center _800">Created at : {{ $lecture->created_at }}</p>
                </div>
            </div>

            <div class=" col">
                <div class="box p-a">
                    <div class="item">
                        <div class="item-bg primary h6" style="height: 3rem">
                            <p class="p-a text-center">Files</p>
                        </div>
                        <div class="p-a pos-rlt">
                        </div>
                    </div>
                    <div class="p-a">
                        <div class="table-responsive">
                            <table class="table table-striped b-t text-center">
                                <thead>
                                    <tr>
                                        <th>pdf Links</th>
                                        <th class="text-center">Download</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lecture->pdfFiles as $pdfFile)
                                        <tr>
                                            <td class="text-left">{{ $pdfFile->pdf_link }}</td>
                                            <td class="h4"><a href="{{ asset($pdfFile->pdf_link) }}" download>
                                                    <i class="fa fa-download text-primary "></i></a></td>
                                            <td class="h4">
                                                <form action="{{ route('lectures.destroy-pdf', $pdfFile) }}" method="POST"
                                                    onsubmit="return confirm('Delete file {{ $pdfFile->pdf_link }} ?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-outline-danger border-0"><i
                                                            class="fa fa-trash text-danger"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        const startTime = document.getElementById('start_time');
        const endTime = document.getElementById('end_time');
        const submitBtn = document.getElementById('submit-btn');
        document.getElementById('myForm').addEventListener('submit', function(event) {
            // Prevent form submission
            event.preventDefault();
            const startTimeVal = new Date("2023-01-01 " + startTime.value);
            const endTimeVal = new Date("2023-01-01 " + endTime.value);

            var starttimestamp = startTimeVal.getTime();
            var endtimestamp = endTimeVal.getTime();
            // Check condition
            if (endtimestamp < starttimestamp) {
                // Display error message
                alert('Your error message here');
            } else {
                // Submit form
                this.submit();
            }
        });
    </script>
    <!-- ############ PAGE END-->
@endsection

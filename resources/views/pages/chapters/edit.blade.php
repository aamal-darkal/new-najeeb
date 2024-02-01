@extends('layouts.master')
@section('content')
    <div class="mt-2 ml-5">
        <a class="md-btn md-raised primary text-white" href="{{ route('packages.show', ['package' => $package]) }}"><i
                class="fas fa-long-arrow-left"></i></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="container-fluid">

                    <div class="row p-2 b-a b-primary b-2x text-center bg-white ">
                        <div class="col-6">
                            @if ($package->image)
                                <img src="{{ asset('storage/images/packages/' . $package->image) }}" width="100%"
                                    height="130px">
                            @else
                                <img src="{{ asset('storage/images/packages/no-image.png') }}" width="100%"
                                    height="130px">
                            @endif
                        </div>
                        <div class="p-2 text mt-1 col-6">
                            <div class=" _800">
                                <div class="text-primary">package Name: </div>
                                {{ $package->name }}
                            </div>
                            <div class="text-primary text _800">Starts at:
                                <div class="text-dark _100 ">{{ $package->start_date }}</div>
                            </div>
                            <div class="text-primary text _800">Ends at:
                                <div class="text-dark _100 ">{{ $package->end_date }}</div>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>


            {{-- ************** form box ***************** --}}
            <div class="col-md-5  p-2">
                <div class="box">
                    <div class="box-header text-primary">
                        <span class="label primary pull-right text-sm">{{ $package->subjects->count() + 1 }}</span>
                        <h2>Edit subject</h2>
                    </div>
                    <div class="box-body">
                        <div class="text-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>

                        <form role="form" method="POST" id="myForm"
                            action="{{ route('subjects.update', $subject) }}">
                            @csrf
                            @method('put')
                            <input type="hidden" value="{{ $package->id }}" name="package_id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ old('name', $subject->name) }}" placeholder="Enter Name" name="name"
                                    maxlength="100" required>
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="cost">Cost</label>
                                    <input type="number" class="form-control" id="cost"
                                        value="{{ old('cost', $subject->cost) }}" placeholder="Enter Cost" name="cost"
                                        min=0 required>
                                    <div class="text-danger">
                                        @error('cost')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                                          
                            <button type="submit" class="btn primary m-b" id="submit-btn">Save Subject</button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    @endsection

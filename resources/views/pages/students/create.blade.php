@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box col-md-6 offset-md-3">
            <div class="box-header">
                <h2 class="text-primary text-2x">Add new Student</h2>
            </div>
            <div class="box-divider m-0"></div>
            <div class="box-body">

                {{-- template for subject label --}}
                <div id="template-subject" class="d-none">
                    <div class="alert alert-success p-1 d-inline">
                        <button type="button" class="btn btn-sm bg-transparent" onclick="delete_subject(this)"> <i
                                class="fas fa-close"></i> </button>
                        <input type="hidden" name="amount" value="50">
                        <input type="hidden" name="subjects_ids[]" value="">
                        <span class="d-inline"></span>
                    </div>
                </div>
                {{-- end of template --}}

                {{-- template for select subject --}}
                <div class="d-none">
                    <select id='data-list'>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" data-fk="{{ $subject->package_id }}"
                                data-info="{{ $subject->package->name }} - {{ $subject->name }}"
                                data-cost={{ $subject->cost }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- end of template --}}

                <form role="form" method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="first_name">First name</label>
                                <input type="text" id="first_name" class="form-control" placeholder="Enter First name"
                                    name="first_name" value="{{ old('first_name') }}" required max="50">

                                <div class="text-danger">
                                    @error('first_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <label for="last_name">Last name</label>
                                <input type="text" id="last_name" class="form-control" placeholder="Enter Last name"
                                    name="last_name" value="{{ old('last_name') }}" required max="50">
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
                                    name="father_name" value="{{ old('father_name') }}" required max="50">
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
                                        <option value="{{ $governorate }}" @selected(old('governorate') == $governorate)>
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
                                    value="{{ old('phone') }}" required minlength="10" maxlength="10"
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
                                    placeholder="Enter parent phone" name="parent_phone" value="{{ old('parent_phone') }}"
                                    minlength="10" maxlength="10" pattern="[0-9]{10}" title="enter valid phone">
                                <div class="text-danger">
                                    @error('parent_phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ********************************* subjects ************************ --}}

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="packages">packages</label>
                                {{-- <select id='packages' --}}
                                <select id='packages' onchange="filter(this, 'subjects')"
                                    class="form-control mt-2 ui search selection dropdown">

                                    <option value="" selected hidden>--select packages</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">
                                            {{ $package->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="subjects">subjects</label>
                                <select id='subjects' onchange="addSubject(this)"
                                    class="form-control mt-2 ui dropdown search selection ">
                                    <option value="" selected hidden> -- add subjects </option>

                                </select>
                                <div class="text-danger">
                                    @error('subjects_ids')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group- my-2">
                        <div class="row">
                            {{-- template --}}
                            <div id="subject-names" class="col">
                                <div class="row">

                                </div>
                            </div>
                            <div class="col-md-3 text-secondary py-2">
                                <label for="sum-subject">sum of subject</label>
                            </div>
                            <div class="col-md-3"><input id="sum-subject" type="text" value=0
                                    class="form-control w-sm" disabled>
                            </div>
                        </div>
                    </div>
                    {{-- ********************* end of subjects **************************** --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="amount">amount</label>
                                <input type="number" class="form-control" placeholder="Enter amount" name="amount"
                                    id="amount" value="{{ old('amount') }}" required>
                                <div class="text-danger">
                                    @error('amount')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <label for="land_line">Land line</label>
                                <input type="text" id="land_line" class="form-control"
                                    placeholder="Enter land line number" name="land_line" value="{{ old('land_line') }}"
                                    minlength="7" maxlength="10" pattern="[0-9]{7,10}" title="enter valid phone">
                                <div class="text-danger">
                                    @error('land_line')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="bill_number">bill_number</label>
                                <input type="text" id="bill_number" class="form-control"
                                    placeholder="Enter bill Number" name="bill_number" value="{{ old('bill_number') }}"
                                    pattern="[0-9]{1-20}" maxlength="20">
                                <div class="text-danger">
                                    @error('bill_number')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <label for="payment_method">payment method</label>
                                <select name="payment_method_id" id="payment_method" class="form-control" required>
                                    <option hidden selected value="">Enter Payment Method</option>
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <option value="{{ $paymentMethod->id }}" @selected($paymentMethod->id == old('payment_method_id'))>
                                            {{ $paymentMethod->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('payment_method_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn primary m-b">Add Student</button>
                </form>
            </div>
        </div>
        @push('css')
            <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
        @endpush

        @push('js')
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

            <script>
                var selectedSubjects = []

                function filter(parentList, filteredList) {
                    dataList = document.getElementById('data-list')
                    filteredList = document.getElementById(filteredList)
                    clearList(filteredList)
                    filteredList.options[0].selected = true //check
                    for (option of dataList.options) {
                        if (option.getAttribute('data-fk') == parentList.value) {
                            if (!selectedSubjects.includes(option.value)) {
                                selectedSubjects.push(option.value)
                                let optionElement = option.cloneNode(true)
                                filteredList.appendChild(optionElement)
                            }
                        }
                    }
                }

                function clearList(list) {
                    for (let i = 1; i < list.options.length; i++) {
                        list.remove(i)
                    }
                }


                function doAddSubject(subjectId, subjectCost, label) {
                    let template = document.getElementById("template-subject").children[0]
                    let newSubject = template.cloneNode(true)
                    newSubject.children[1].value = subjectCost
                    newSubject.children[2].value = subjectId
                    newSubject.children[3].innerHTML = label
                    document.querySelector("#subject-names .row").appendChild(newSubject)
                    document.getElementById("sum-subject").value = Number(document.getElementById("sum-subject").value) + Number(
                        subjectCost)
                }

                function addSubject(inp) {
                    let selectedOption = inp.options[inp.selectedIndex]
                    let subjectId = selectedOption.value
                    let subjectCost = selectedOption.getAttribute('data-Cost')
                    let label = selectedOption.getAttribute('data-info')
                    doAddSubject(subjectId, subjectCost, label)
                }

                function delete_subject(inp) {
                    subjectCost = inp.nextElementSibling.value
                    document.getElementById("sum-subject").value = Number(document.getElementById("sum-subject").value) - Number(
                        subjectCost)
                    inp.parentNode.remove();
                }
            </script>

            <script>
                $('.ui.dropdown').dropdown();
            </script>
        @endpush
    @endsection

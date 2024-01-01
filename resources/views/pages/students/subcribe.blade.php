@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box col-md-6 offset-md-3">
            <div class="box-header">
                <a class="md-btn md-raised primary text-white m-0" href="{{ route('students.show', $student) }}"><i
                        class="fas fa-long-arrow-left"></i></a>
                <h2 class="text-primary text-2x d-inline ml-2"> Subcribe {{ $student->first_name }}
                    {{ $student->father_name }}
                    {{ $student->last_name }}</h2>
            </div>
            <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
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

                <form role="form" method="POST" action="{{ route('students.subcribe-store', $student) }}">
                    @csrf

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
                            <div class="col-md-3"><input id="sum-subject" type="text" value=0 class="form-control"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    {{-- ********************* end of subjects **************************** --}}
                    <input class='my-2' type="checkbox" onchange="changePaymentState(this)"> <span class="text-primary text-md _800">Without payment</span>
                    <div class="form-group p-2">
                        <div class="row">
                            <div class="col">
                                <label for="amount">amount</label>
                                <input type="number" data-payment class="form-control" placeholder="Enter amount"
                                    name="amount" id="amount" value="{{ old('amount') }}" required>
                                <div class="text-danger">
                                    @error('amount')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-2">
                        <div class="row">
                            <div class="col">
                                <label for="bill_number">bill_number</label>
                                <input type="text" data-payment id="bill_number" class="form-control"
                                    placeholder="Enter bill Number" name="bill_number" value="{{ old('bill_number') }}"
                                    pattern="[0-9]{1,20}" maxlength="20" required>
                                <div class="text-danger">
                                    @error('bill_number')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <label for="payment_method">payment method</label>
                                <select data-payment name="payment_method_id" id="payment_method" class="form-control"
                                    required>
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
                    <button type="submit" class="btn primary m-b">Subcribes</button>
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
        @endpush

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

            function changePaymentState(checkInp) {
                let paymentFields = document.querySelectorAll('[data-payment]')
                for (paymentField of paymentFields)
                    if (checkInp.checked)
                        paymentField.disabled = true
                else
                    paymentField.disabled = false
            }
        </script>

        <script>
            $('.ui.dropdown').dropdown();
        </script>
    @endsection

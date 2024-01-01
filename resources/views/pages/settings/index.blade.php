@extends('layouts.master')
@section('content')
    {{-- ***************************  packages ************************** --}}
    <div class="padding">
        <div class="box col-md-10 offset-md-1">

            <div class="box-header text-primary d-flex justify-content-between">
                <h2> Settings</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-a b-2x text-center no-wrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th>key</th>
                            <th>value</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting)
                            <tr>
                                <td></td>
                                <td>{{ $setting->description }}</td>
                                <form action="{{ route('settings.update', $setting) }}" method="POST">
                                    <td class=""><input type="text" class="form-control w-100" style="min-width: 300px" value="{{ $setting->value }}" name="value" disabled></td>
                                    <td class="text-left">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-outline-primary" onclick="return openEdit(this)">Edit</button>
                                        <button type="button" class="btn btn-outline-secondary d-none" onclick="return closeEdit(this)" >cancel</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    @push('js')
        <script>
            function openEdit(btn) {
                btn.classList.toggle('btn-primary')

                if (btn.innerHTML == "Edit") {
                    btn.innerHTML = "save"
                    btn.parentNode.previousElementSibling.firstChild.disabled = false
                    btn.nextElementSibling.classList.add('d-inline')
                    return false;
                } else return true;                
            }
            function closeEdit(btn) {
                btn.classList.remove('d-inline')
                btn.parentNode.previousElementSibling.firstChild.disabled = true
                btn.previousElementSibling.innerHTML = "Edit"
            }


        </script>
    @endpush
@endsection

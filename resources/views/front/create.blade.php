@extends('layouts.app')
@section('content')

    <body>
        <style>
            .error-message {
                color: red;
                font-size: 12px;

            }

            #myForm {
                width: 400px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
        </style>
    </body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" id="formdata">
                            @csrf

                            <div class="md-0">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name">


                            </div>


                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email">


                            </div>

                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">

                            </div>

                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="Enter your number">

                            </div>
                            <div class="form-group mb-0">

                                <label class="form-label">Hobbies</label>
                                <select class="hobbies col-12" multiple="multiple" name="hobbies[]" id="hobbies">
                                    @foreach ($hobbies as $item)
                                        <option value="{{ $item->id }}">{{ $item->hobbies }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group mb-0">
                                <label for="exampleFormControlInput1" class="form-label">Country</label>
                                <select id="country_id" class="form-control" name="country_id">
                                    <option value="">-- Select Country --</option>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item->id }}">{{ $item->countryname }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label for="exampleFormControlInput1" class="form-label">State</label>
                                <select id="state_id" class="form-control" name="state_id">
                                    <option value="">-- Select state --</option>
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label for="exampleFormControlInput1" class="form-label">City</label>
                                <select id="city_id" class="form-control" name="city_id">
                                    <option value="">-- Select city --</option>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    <label for="exampleFormControlInput1" class="form-label">Address</label>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="useraddress[]" placeholder="Enter your address"
                                                    id="useraddress[]" class="form-control name_list" />
                                            </td>
                                            <td>
                                                <button type="button" name="add" id="add"
                                                    class="btn btn-success">AddMore
                                                </button>
                                            </td>
                                        </tr>
                                        @if ($errors->has('useraddress.*'))
                                            <span class="error">{{ $errors->first('useraddress.*') }}</span>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter your password" autocomplete="on">

                            </div>
                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm your password" id="confirm_password" autocomplete="on">
                            </div>
                            <div class="row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submit">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#country_id').change(function() {
                var country_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url: "{{ route('get_state') }}",
                    data: {
                        country_id: country_id
                    },
                    success: function(data) {
                        html = '<option value="">Select a state</option>';

                        $.each(data.state, function(key, value) {
                            html += '<option value="' + value.id + '">' + value.state +
                                '</option>';
                        });

                        $('#state_id').html(html);
                    },
                    error: function(error) {

                    }
                });
            });
            // });
            // $(document).ready(function() {
            $(".hobbies").select2();
            // });
            // $(document).ready(function() {
            $('#state_id').change(function() {
                var city_id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('city') }}",
                    data: {
                        city_id: city_id
                    },
                    success: function(data) {
                        html = '<option value="">Select a city</option>';
                        $.each(data.city, function(key, value) {
                            html += '<option value="' + value.id + '">' + value.city +
                                '</option>';
                        });
                        $('#city_id').html(html);
                    },
                    error: function(error) {

                    }
                });
            });

            var i = 1;

            function addRow() {
                i++;
                var clone = $('#dynamic_field tbody tr:last').clone();
                $('#dynamic_field tbody').append(clone);
                var remove = $('<button class="btn_remove" name="remove" type="button">X</button>');
                clone.append(remove);
            }

            $('#add').click(function() {
                addRow();
            });

            $(document).on('click', '.btn_remove', function() {
                $(this).closest('tr').remove();
            });


            $('#formdata').submit(function(e) {
                e.preventDefault();
                var formData = $('#formdata').serialize();
                $.ajax({
                    url: "{{ route('userStore') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Your form has been sent successfully.');
                        window.location.href = "{{ route('userRegister') }}"
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                if (key.startsWith("useraddress.")) {

                                    var fieldName = key.replace("useraddress.",
                                        "");
                                    $("#dynamic_field").find(
                                            'input[name="useraddress[]"]').eq(fieldName)
                                        .after(
                                            '<span class="error-message">' + value +
                                            '</span>');
                                } else {

                                    $("#" + key).after('<span class="error-message">' +
                                        value + '</span>');
                                }
                            });
                        }
                    }
                });
            });
        });
        // });
    </script>
@endpush

@extends('layouts.app')
@section('content')

    <body>
        <style>
            .error-message {
                color: red;
                font-size: 12px;
            }
        </style>
    </body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }} ">
                            @csrf
                            <div class="form-group col-md-10 required">
                                Name: <input type="name" name="name" id="name">
                                @error('name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div><br>
                            <div class="form-group col-md-10 required">
                                <label for="email">Enter your email:</label>
                                <input type="email" name="email" id="email">
                                @error('email')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div><br>
                            <div class="form-group col-md-10 required">
                                Date of birth: <input type="date" name="dob" id="dob">
                                @error('dob')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div><br>

                            <div class="form-group col-md-10 required">
                                Phone: <input type="tel" name="phone" id="phone">
                                @error('phone')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div><br>
                            <div>
                                <select id="country-dd" class="form-control" name="country_id">
                                    <option value="">-- Select Country --</option>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item->id }}">{{ $item->countryname }}</option>
                                    @endforeach
                                </select>
                                @error('country-dd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-10">
                                <select id="state-dd" class="form-control" name="state_id">
                                    <option value="">-- Select state --</option>
                                </select>
                                @error('state-dd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-10">
                                <select id="city-dd" class="form-control" name="city_id">
                                    <option value="">-- Select city --</option>
                                </select>
                                @error('city-dd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-10 required">
                                Password: <input type="password" name="password" id="password" autocomplete="on">
                                @error('password')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div><br>
                            <div class="form-group col-md-10 required">
                                Confirm Password: <input type="password" name="confirm_password" id="confirm_password"
                                    autocomplete="on">
                                @error('confirm_password')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div><br>
                            <div class="row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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
            $('#country-dd').change(function() {
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

                        $('#state-dd').html(html);
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#" + key).after(
                                    '<span class="error-message">' +
                                    value + '</span>');
                            });
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#state-dd').change(function() {
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
                        $('#city-dd').html(html);
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#" + key).after(
                                    '<span class="error-message">' +
                                    value + '</span>');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush

@extends('admin.layouts.master')
@section('title', 'create country')
@push('style')
@endpush
@section('content')
    <body>
        <style>
            .error {
                border: 1px solid red;
            }

            .error-message {
                color: red;
                font-size: 12px;
            }
        </style>
    </body>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <div class="container">
            <div class="row">
                <div class="row justify-content-center">
                    <div class="col-md-8 ">
                        <div id="success"></div>
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    Add writers
                                    <a href="{{ route('write.index') }}" class="'btn btn-danger btn-sm float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form id="addcountry">
                                    @csrf
                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label">writers</label>
                                        <input type="text" class="form-control" id="write" name="write" placeholder="Enter writers">
                                        @error('write')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                        @error('email')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status">Status:</label>
                                        <input type="radio" name="status" id="active" value="1">active
                                        <input type="radio" name="status" id="inactive" value="0">inactive<br><br>
                                    </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </h2>
@endsection
{{-- @push('script')
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#addcountry', function(event) {
                event.preventDefault();
                var ajaxData = new FormData(this);
                var value = "an error occured";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('country.store') }}",
                    data: ajaxData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        window.location.href = "{{ route('country.index') }}";
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#" + key).after('<span class="error-message">' + value + '</span>');
                            });
                        }
                    }
                })
            });
        });
    </script>
@endpush --}}

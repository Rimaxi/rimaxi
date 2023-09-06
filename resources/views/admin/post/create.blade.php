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
                                    Add posts
                                    <a href="{{ route('post.index') }}" class="'btn btn-danger btn-sm float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form id="addpost">
                                    @csrf
                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter Title">
                                        @error('title')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <form class="form-horizontal" role="form" name="f3" id="f3">
                                        <div class="form-group">
                                            <label><strong>Description :</strong></label>
                                            <textarea class="ckeditor" id="description" name="description">{!! $post->description !!}</textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="exampleFormControlInput1" class="form-label">writer</label>
                                            <select id="write_id" class="form-control" name="write_id">
                                                <option value="">-- Choose writer --</option>
                                                @foreach ($write as $item)
                                                    <option value="{{ $item->id }}">{{ $item->write }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </h2>
@endsection
@push('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            jQuery(document).ready(function($) {
                $(".ckeditor").ckeditor({});
            });

            $("#f3").validate({
                rules: {
                    description: {
                        required: function() {
                            CKEDITOR.instances.description.updateElement();
                        },
                    }
                },
            });
        });

        $(document).ready(function() {
            $(document).on('submit', '#addpost', function(event) {
                event.preventDefault();
                var ajaxData = new FormData(this);
                var value = "an error occured"
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('post.store') }}",
                    data: ajaxData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        window.location.href = "{{ route('post.index') }}"
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#" + key).after('<span class="error-message">' +
                                    value + '</span>');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush

@extends('admin.layouts.master')
@section('title', 'Edit User')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Form') }}
                    <h4>
                        <a href="{{ route('write.index') }}" class="'btn btn-danger btn-sm float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form id="update">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Writer Name</label>
                            <input type="text" name="write" value="{{ old('write', $write->write) }}"
                                class="form-control">
                            @if ($errors->has('write'))
                                <span class="text-danger">{{ $errors->first('write') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">email</label>
                            <input type="text" name="email" value="{{ old('email', $write->email) }}"
                                class="form-control">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <button type="update" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
     $(document).on('click','#update', function(event) {
            event.preventDefault();
            var ajaxData = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: "{{ route('write.update', $write->id) }}",
                data: ajaxData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    window.location.href = "{{ route('write.index') }}"
                },
                error: function(error) {}
            });
        });
</script>
@endpush

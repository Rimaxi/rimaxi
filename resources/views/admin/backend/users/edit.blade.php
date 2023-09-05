@extends('admin.layouts.master')
@section('title', 'Edit User')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Form') }}
                        <h4>
                            <a href="{{ route('front') }}" class="'btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form id="update">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">User Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">email</label>
                                <input type="text" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">dob</label>
                                <input type="date" name="dob" value="{{ old('dob', $user->dob) }}"
                                    class="form-control">
                                @if ($errors->has('dob'))
                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">phone</label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="form-control">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-0">
                                <label class="form-label">Hobbies</label>
                                <select class="hobbies col-12" multiple="multiple" name="hobbies[]" id="hobbies">
                                    @foreach ($hobbies as $item)
                                        <option value="{{ $item->id }}"
                                            {{ in_array($item->id, explode(',', $user->hobbies)) ? 'selected' : '' }}>
                                            {{ $item->hobbies }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label for="exampleFormControlInput1" class="form-label">Country</label>
                                <select id="country_id" class="form-control" name="country_id">
                                    <option value="">-- Select Country --</option>
                                    @foreach ($countries ?? [] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('country_id', $user->country_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->countryname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label for="exampleFormControlInput1" class="form-label">State</label>
                                <select id="state_id" class="form-control" name="state_id">
                                    <option value="">-- Select state --</option>
                                    @foreach ($state ?? [] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('state_id', $user->state_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->state }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label for="exampleFormControlInput1" class="form-label">City</label>
                                <select id="city_id" class="form-control" name="city_id">
                                    @foreach ($city ?? [] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('city_id', $user->city_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->city }}</option>
                                    @endforeach
                                </select>
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
                type: 'POST',
                url: "{{ route('update', $user->id) }}",
                data: ajaxData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    window.location.href = "{{ route('front') }}"
                },
                error: function(error) {}
            });
        });
        jQuery(document).ready(function($) {
            $(".hobbies").select2();
        });
    </script>
@endpush

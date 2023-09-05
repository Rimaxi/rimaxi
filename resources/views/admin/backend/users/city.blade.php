@extends('admin.layouts.master')
@section('title', 'Datatable')
@push('style')
@endpush
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('city.create') }}" class="btn btn-primary btn-sm float-end">Add City</a>
                    </div>
                    <h1>DataTables</h1>
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
                    $(document).on('click', '.badge', function() {
                        var id = $(this).data('id');
                        // Do something with the ID, like sending it via AJAX or using it in your logic
                    });
                });
    </script>
@endpush

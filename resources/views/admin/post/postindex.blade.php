@extends('admin.layouts.master')
@section('title', 'Datatable')
@push('style')
@endpush
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" id="mycountry">
                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm float-end">Add Posts</a>
                    </div>
                    <h1>DataTables</h1>
                    {!! $dataTable->table() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}
@endpush

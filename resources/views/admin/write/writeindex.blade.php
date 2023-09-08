@extends('admin.layouts.master')
@section('title', 'Datatable')
@push('style')
@endpush
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" id="delete">
                        <a href="{{ route('write.create') }}" class="btn btn-primary btn-sm float-end">Add Writer</a>
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
    <script>
        $('body').on('click', '.delete', function() {
            var id = $(this).data('id');

            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('write.destroy', 'write') }}",
                    type: 'POST',
                    success: function(result) {
                        $('#write-table').DataTable().ajax.reload();
                    }
                });
            }
        });
    </script>
@endpush

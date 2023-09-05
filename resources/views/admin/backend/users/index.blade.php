@extends('admin.layouts.master')
@section('title', 'Datatable')
@push('style')
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <table class="table table-hover" id="delete">
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
                    url: "{{ route('delete') }}/" + id,
                    method: 'POST',
                    success: function(result) {
                        // Refresh the DataTable
                        $('#user-table').DataTable().ajax.reload();
                    }
                });
            }
        });
        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('edit') }}/" + id,
                method: 'GET',
                success: function(result) {
                    $('#user-table').DataTable().ajax.reload();
                }
            });
        });
        
    </script>
@endpush

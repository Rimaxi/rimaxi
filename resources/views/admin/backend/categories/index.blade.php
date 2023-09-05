@extends('admin.layouts.master')
@section('title', 'Add User')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('status'))
                        <h6 class="alert alert-warning">{{ session('status') }}</h6>
                    @endif

                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" class="form-controller" id="search" name="search">
                        </div>
                    </div>
                    <h4>FOODS</h4>
                    <a href="{{ route('food.create') }}" class="btn btn-primary float-end">Add vegetarion food</a>
                    @csrf
                    <div class="card-body" id="mydiv">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>cousin</th>
                                    <th>Status</th>
                                    <th>Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="search-results">
                                @foreach ($food as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->cousin }}</td>
                                        <td>
                                            <button id="status-toggle" data-id="{{ $item->id }}"
                                                data-status="{{ $item->status }}">
                                                {{ $item->status ? 'Active' : 'Inactive' }}
                                            </button>

                                        </td>
                                        <td>
                                            <a href="{{ route('food.show', ['food' => $item->id]) }}"
                                                class="btn btn-primary">Show</a>

                                        <td>
                                            <a href="{{ route('food.edit', ['food' => $item->id]) }}"
                                                class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('food/' . $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Trash</button>
                                            </form>
                                        </td>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        @endsection
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"
        integrity="sha256-mW1wrhuKp2Cl0DCVr/7+GTdl168ZrmB6FayoMAlSmH0=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#status-toggle', function() {
                const id = $(this).data('id');
                const status = $(this).data('status');

                $.ajax({

                    url: "{{ route('status') }}/" + id,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: status

                    },
                    success: function(response) {

                        $("#mydiv").load(location.href + " #mydiv");
                        const newStatus = status;
                        $(this).data('status', newStatus);
                        $(this).text(newStatus ? 'Active' : 'Inactive');
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to update?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, update it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'updated!',
                                    'Your status has been updated.',
                                    'success'
                                )
                            }
                        })

                    },
                    error: function(error) {
                        Swal.fire('Error', 'An error occurred', 'error');
                    }
                });
            });
        });
        $('#search').on('keyup', function() {
            var searchValue = $(this).val();
            $.ajax({
                type: 'get',
                url: "{{ route('search') }}",
                data: {
                    'search': searchValue
                },
                success: function(response) {
                    showSearchResults(response.data);
                }
            });
        });

        function showSearchResults(results) {
            var tbody = $('#search-results');
            tbody.empty();
            if (results.length === 0) {
                tbody.append('<tr><td colspan="4">No results found</td></tr>');
            } else {
                results.forEach(function(result) {
                    var row = '<tr>' +
                        '<td>' + result.id + '</td>' +
                        '<td>' + result.name + '</td>' +
                        '<td>' + result.description + '</td>' +
                        '<td>' + result.cousin + '</td>' +
                        '</tr>';
                    tbody.append(row);
                });
            }
        }

    </script>
@endpush

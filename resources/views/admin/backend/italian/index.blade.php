@extends('admin.layouts.master')
@section('title', 'Add Italian Food')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h4>Italian Foods</h4>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>price</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

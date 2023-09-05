@extends('admin.layouts.master')
@section('title', 'Edit User')
@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('status'))
                        <h6 class="alert alert-warning">{{ session('status') }}</h6>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Edit Food
                                <a href="{{ route('food.index') }}" class="'btn btn-danger btn-sm float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('food.update', ['food' => $food->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="">Food Name</label>
                                    <input type="text" name="name" value="{{ old('name', $food->name) }}"
                                        class="form-control">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">description</label>
                                    <input type="text" name="description"
                                        value="{{ old('description', $food->description) }}" class="form-control">
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">cousin</label>
                                    <input type="text" name="cousin" value="{{ old('cousin', $food->cousin) }}"
                                        class="form-control">
                                    @if ($errors->has('cousin'))
                                        <span class="text-danger">{{ $errors->first('cousin') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <button type="update" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </h2>
@endsection

@extends('admin.layouts.master')
@section('title', 'Show User')
@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Show Vegetarion Food Data
                            <a href="{{ route('food.index') }}" class="btn btn-danger btn-sm float-end">BACK</a>
                        </h4>
                    </div>
                    <b><label>Food Name</label></b>
                    <h4>{{ $food->name }}</h4>
                    <hr>
                    <b><label>Food Description</label></b>
                    <h4>{{ $food->description }}</h4>
                    <hr>
                    <b><label>Cousin</label></b>
                    <h4>{{ $food->cousin }}</h4>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection

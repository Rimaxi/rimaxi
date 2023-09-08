@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
            {{ __('You are logged in!') }}

            <!-- Main Navigation -->
            <header>
                <!-- Jumbotron -->
                <div class="p-3 text-center bg-white border-bottom">
                    <div class="container">
                        <div class="row gy-3">
                            <!-- Left elements -->
                            <div class="col-lg-4 col-sm-6 col-6">
                                <a href="https://mdbootstrap.com/" target="_blank" class="float-start">
                                    <img src="https://freevector-images.s3.amazonaws.com/uploads/vector/preview/31261/LiverBirdHead829.png"
                                        height="55" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <!-- Container wrapper -->
                    <div class="container justify-content-center justify-content-md-between">
                        <!-- Toggle button -->
                        <button class="navbar-toggler border py-2 text-dark" type="button" data-mdb-toggle="collapse"
                            data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>

                        <!-- Collapsible wrapper -->
                        <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                            <!-- Left links -->
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <!-- Navbar dropdown -->
                            </ul>
                            <!-- Left links -->
                        </div>
                    </div>
                    <!-- Container wrapper -->
                </nav>
                <!-- Navbar -->
                <!-- Jumbotron -->
                <div class="bg-primary text-white py-5">
                    <div class="container py-5">
                        <h1>
                            Best Books & <br />
                            Novels in our store
                        </h1>
                        <p>
                            Trendy Products, Factory Prices, Excellent Service
                        </p>
                        <button type="button" class="btn btn-outline-light">
                            Learn more
                        </button>
                        <button type="button" class="btn btn-light shadow-0 text-primary pt-2 border border-white">
                            <span class="pt-1">Purchase now</span>
                        </button>
                    </div>
                </div>
                <!-- Jumbotron -->
            </header>

            <!-- Products -->
            <div>
                <form action="{{ route('home') }}" method="GET">
                    <label for="write">Filter by Writer:</label>
                    <select name="write_id" id="write">
                        <option value="">All Writers</option>
                        @foreach ($write as $writer)
                            <option value="{{ $writer->id }}">{{ $writer->write }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Apply Filter</button>
                </form>
            </div>
            <section>
                <div class="container my-5">
                    <header class="mb-4">
                        <h3>New products</h3>
                    </header>
                    <div class="ajax-class">
                        @include('post-list');
                    </div>

                </div>
            </section>

            <div class="">
                <div class="container">
                    <div class="d-flex justify-content-between py-4 border-top">
                        <!-- Payment icons -->
                        <div>
                            <i class="fab fa-lg fa-cc-visa text-dark"></i>
                            <i class="fab fa-lg fa-cc-amex text-dark"></i>
                            <i class="fab fa-lg fa-cc-mastercard text-dark"></i>
                            <i class="fab fa-lg fa-cc-paypal text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#write').on('change', function() {
                var writeid = $(this).val();
                $.ajax({
                    url: "{{ route('home') }}",
                    method: 'GET',
                    data: {
                        write_id: writeid
                    },
                    success: function(response) {
                        $('.ajax-class').html(response.html);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush

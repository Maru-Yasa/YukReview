@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-9 rounded-5 row shadow px-3 py-4">

            <div class="col-md-2">
                <img src="{{ $movie->poster }}" class="img-thumbnail" alt="">
            </div>
            <div class="col-md-8">
                <div class="mb-1">
                    <span class="fs-2 fw-bold">Title : {{ $movie->title }}</span>
                </div>
                <span class="badge rounded-pill bg-warning">{{ $movie->title }}</span>
                <div class="mb-1">
                    <span>Duration : {{ $movie->duration }}</span>
                </div>
                <div class="mb-1">
                    <span>{{ $movie->rating }}/10 <i class="bi bi-star-fill text-warning"></i></span>
                </div>
                <div class="mt-2 mb-1">
                    <p>{{ $movie->synopsis }}</p>
                </div>
            </div>

        </div>

        <div class="col-10 col-md-9 rounded-5 mt-5 row shadow px-3 py-4">

            <h2>Reviews</h2>

            <div class="col-md-8">
                <form action="">
                    <div class="mb-3">
                      <label for="" class="form-label">Your Review</label>
                      <textarea class="form-control" name="" id="" rows="3"></textarea>
                    </div>
                </form>
            </div>

        </div>


    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')

<div class="mx-0 bg-primary">
    <div class="p-5 bg-primary text-white">
            <h1 class="display-3"> <i class="bi bi-film"></i> YukReview</h1>
            <p class="lead">Web that designed to review movies</p>
    </div>
</div>


<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0d6efd" fill-opacity="1" d="M0,192L48,170.7C96,149,192,107,288,117.3C384,128,480,192,576,218.7C672,245,768,235,864,208C960,181,1056,139,1152,144C1248,149,1344,203,1392,229.3L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
<div class="container mb-5">
    <div class="mb-3">
        <h2 class="fw-bold"> <i class="bi bi-film"></i> Movies</h2>
    </div>

    <div class="row mt-5 justify-content-center">

        @foreach ($movies as $movie)
        <div class="col-6 col-md-3 my-3">
            <div class="card">
                <img class="card-img-top img-thumbnail" src="{{ $movie->poster }}" style="" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{ $movie->title }}</h4>
                    <span class="badge rounded-pill bg-warning">{{ $movie->genre }}</span>
                    <div class="my-2">
                        <span class="my-3">{{ $movie->rating }}/10 <i class="bi bi-star-fill text-warning"></i></span>
                    </div>
                    <p class="card-text cut-text">{{ $movie->synopsis }}</p>
                    <a href="{{ route('movieDetail', ['id' => $movie->id]) }}" class="d-block btn btn-outline-primary">See detail</a>
                </div>
            </div>
        </div>
        @endforeach

        {{ $movies->links() }}

    </div>

</div>

@endsection

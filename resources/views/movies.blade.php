@extends('layouts.app')

@section('content')
<div class="container mb-5 mt-5">
    <div class="mb-3">
        <h2 class="fw-bold"> <i class="bi bi-film"></i> Movies</h2>
    </div>

    <div class="row mt-5 justify-content-center">

        <div class="col-10 row justify-content-center">
            <form action="" method="GET">
                <div class="input-group col-md-6 mb-3">
                    <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search local's movie" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2"> <i class="bi bi-search"></i> search</button>
                </div>                
            </form>

        </div>

        @foreach ($movies as $movie)
        <div class="col-6 col-md-3 my-3">
            <div class="card">
                <img class="card-img-top img-thumbnail" src="{{ $movie->poster }}" style="" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{ $movie->title }}</h4>
                    <span class="badge rounded-pill bg-warning">{{ $movie->genre }}</span>
                    <div class="my-2">
                        <span class="my-3">{{ $movie->rating }}/10 <i class="bi bi-star-fill text-warning"></i> | {{ $movie->rating_count }} <i class="bi bi-person-fill"></i> </span>
                    </div>
                    <p class="card-text cut-text">{{ $movie->synopsis }}</p>
                    <a href="{{ route('movieDetail', ['id' => $movie->id]) }}" class="d-block btn btn-outline-primary">See detail</a>
                </div>
            </div>
        </div>
        @endforeach

        {{ $movies->links("pagination::bootstrap-5") }}

    </div>

</div>
@endsection

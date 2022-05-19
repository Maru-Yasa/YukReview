@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-10 bg-white col-md-9 mt-5 rounded-5 row shadow px-3 py-4">

            <div class="col-md-2">
                <img src="{{ $movie->poster }}" class="img-thumbnail" alt="">
            </div>
            <div class="col-md-8">
                <div class="mb-1">
                    <span class="fs-1 fw-bold">{{ $movie->title }}</span>
                </div>
                <span class="badge rounded-pill bg-warning">{{ $movie->genre }}</span>
                <div class="mb-1">
                    <span>Duration : {{ $movie->duration }}</span>
                </div>
                <div class="mb-1">
                    <span>{{ $movie->rating }}/10 <i class="bi bi-star-fill text-warning"></i> | {{ $movie->rating_count }} <i class="bi bi-person-fill"></i> </span>
                </div>
                <div class="mt-2 mb-1">
                    <p>{{ $movie->synopsis }}</p>
                </div>
            </div>

        </div>

        <div class="col-12 bg-white col-md-9 mt-5 rounded-5 row justify-content-center shadow px-3 py-4">
            <h2 class="">Trailer</h2>
            <div class="col-12">
                <iframe src="{{ $movie->trailer }}" style="height: 400px;width: 100%;" frameborder="0"></iframe>
            </div>
        </div>

        <div class="col-10 bg-white col-md-9 rounded-5 mt-5 row justify-content-center shadow px-3 py-4">

            <h2>Reviews</h2>

            <div class="col-10 row justify-content-center">

                @if (count($reviews) < 1)
                    <div class="col-12 m-3">
                        <h2 class="fs-3 text-muted">There's no review about this movie yet</h2>
                    </div>
                @endif


                @foreach ($reviews as $re)
                    <div class="card my-3">
                        <div class="card-header row">
                            <div class="col-6">
                                {{ $re->username }}
                            </div>
                            <div class="col-6 text-end">
                                {{ $re->created_at }}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="my-1">
                                @if ($re->rating < 6)
                                    <span class="badge rounded-pill bg-danger" >Bad! <i class="bi bi-hand-thumbs-down-fill text-white"></i></span>
                                @else
                                    <span class="badge rounded-pill bg-success" >Bad! <i class="bi bi-hand-thumbs-up-fill text-white"></i></span>
                                @endif                                
                            </div>

                            <span class="fs-4">{{ $re->rating }}/10 <i class="bi bi-star-fill text-warning"></i></span>
                            <p class="card-text">{{ $re->review }}</p>
                        </div>
                    </div>                    
                @endforeach

                {{ $reviews->links("pagination::bootstrap-5") }}

            </div>

        </div>

        <div class="col-10 bg-white col-md-9 rounded-5 mt-5 row justify-content-center shadow px-3 py-4">

            <div class="col-md-12 row justify-content-center">
                <div class="col-12 ">
                    @if (Session::get('success'))
                        
                        <div class="alert-success p-3 border rounded">
                            {{ Session::get('success') }}
                        </div>

                    @endif
                    <form action="{{ route('createReview') }}" method="POST">
                        @csrf
                        <input type="text" name="movie_id" hidden value="{{ $movie->id }}">
                        <div class="mb-3">
                            <label for="" class="form-label"><i class="bi bi-star-fill text-warning"></i> Rating</label>
                            <select class="form-select" name="rating" id="">
                                @for ($i = 1; $i < 11; $i++)
                                    <option value="{{ $i }}">
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Your Review</label>
                            <textarea class="form-control col-12" name="review" id="" rows="3">{{ old('review') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="captcha" class="form-label">Enter Captcha</label>
                            <div class="col-md-6 mb-2 captcha">
                                <span id="captcha_img">{!! captcha_img() !!}</span>
                                <button onclick="reloadCaptcha()" type="button" class="btn btn-primary " class="reload" id="reload">
                                &#x21bb;
                                </button>
                            </div>
                            <div class="col-md-6">
                                <input id="captcha" required type="text" class="form-control  @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha">
                            </div>

                            @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>                    
                </div>

            </div>

        </div>


    </div>
</div>
<script>
    function reloadCaptcha(params) {
        var url = "{{ route('reloadCaptcha') }}"
        fetch(url, {
            method:"GET",
        })
        .then(response => response.json())
        .then((response) => {
            let data  =  response.captcha;
            let span = document.getElementById('captcha_img');
            span.innerHTML = data;
        })
    }
</script>
@endsection

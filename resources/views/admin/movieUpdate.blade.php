@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   Edit Movie {{ $movie->id }}
                </div>
                <div class="card-body p-5">
                    @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                
                <form action="{{ route('movieUpdate') }}" method="POST">
                    @csrf
                    <input type="text" name="id" value="{{ $movie->id }}" hidden>
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" value="{{ $movie->title }}" class="form-control" name="title" id="title" aria-describedby="" placeholder="">
                    </div>

                    <div class="mb-3">
                      <label for="genre" class="form-label">Genre</label>
                      <input type="text" value="{{ $movie->genre }}" class="form-control" name="genre" id="genre" aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="mb-3">
                      <label for="duration" class="form-label">Duration</label>
                      <input type="text" value="{{ $movie->duration }}" class="form-control" name="duration" id="duration" aria-describedby="" placeholder="">
                    </div>

                    <div class="mb-3">
                      <label for="synopsis" class="form-label">Synopsis</label>
                      <textarea class="form-control" name="synopsis" id="synopsis" rows="5">{{ $movie->synopsis }}</textarea>
                    </div>

                    <div class="mb-3">
                      <label for="poster" class="form-label">Poster Url</label>
                      <input type="text" class="form-control" value="{{ $movie->poster }}" name="poster" id="poster" aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="mb-3">
                      <label for="trailer" class="form-label">Trailer Url</label>
                      <input type="text" class="form-control" value="{{ $movie->trailer }}" name="trailer" id="trailer" aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label"><i class="bi bi-star-fill text-warning"></i> Rating</label>
                        <select class="form-select" name="rating" id="">
                            <option value="{{ $movie->rating }}">{{ $movie->rating }}</option>
                            @for ($i = 1; $i < 11; $i++)
                                <option value="{{ $i }}">
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/admin/movies" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> back</a>
                    </div>

                </form>


                </div>
            </div>
        </div>        
    </div>


</div>
<script>
    $(document).ready(function () {
        $('#userTable').DataTable();
    });
</script>
@if (Session::get('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success..',
        text: "{{ Session::get('success') }}",
    })
</script>
@endif
@endsection

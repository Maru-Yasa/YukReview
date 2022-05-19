@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-5">
                <div class="card-header">
                    Movie Table
                </div>
                <div class="card-body">
                    <a href="{{ route('movieAdd') }}" class="btn btn-primary"> <i class="bi bi-plus"></i> Add</a>
                    <table id="movieTable" class="table">
                        <thead class="border-0 bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Synopsis</th>
                                <th>Poster</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($movies as $movie)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $movie->title }}</td>
                                    <td>{{ $movie->duration }}</td>
                                    <td>{{ $movie->synopsis }}</td>
                                    <td><img src="{{ $movie->poster }}" style="width: 100px" alt=""></td>
                                    <td>{{ $movie->rating }}/10 <i class="bi bi-star-fill text-warning"></i></td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('movieUpdate', ['id' => $movie->id]) }}"><i class="bi bi-pencil-fill"></i></a>
                                        <a class="btn btn-outline-danger btn-sm" href="{{ route('deleteMovie', ['id' => $movie->id]) }}"><i class="bi bi-trash-fill"></i></a>
                                        <a class="btn btn-outline-success btn-sm" href="/detail/{{ $movie->id }}"><i class="bi bi-eye-fill"></i></a>
                                    </td>
                                </tr> 
                                @php
                                    $index++
                                @endphp                           
                            @endforeach

                        </tbody>
                    </table>
                    

                </div>
            </div>
        </div>   
        
        <div class="col-md-8">
            <div class="card shadow mb-5">
                <div class="card-header">
                    Movie Scrapper
                </div>
                <div class="card-body">

                    <div class="mb-3">
                      <label for="" class="form-label">Movie Title or IMDB URL</label>
                      <input type="text" class="form-control" name="" id="url" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">

                        <button onclick="scrap()" class="btn btn-primary">Scrap</button>

                    </div>

                    <script>

                        function scrap(){

                            let url = document.getElementById('url').value
                            console.log(url);
                        }

                    </script>


                </div>
            </div>
        </div>  
    </div>


</div>
<script>
    $(document).ready(function () {
        $('#movieTable').DataTable();
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

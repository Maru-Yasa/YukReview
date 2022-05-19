@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                            $api = `/scrap?name=${url}`;
                            Swal.showLoading();
                            fetch($api).then(response => response.json())
                            .then((data) => {
                                Swal.hideLoading();
                                Swal.fire({
                                    icon: data.status,
                                    title: data.status,
                                    text: `${data.msg}`,
                                    isConfirmed : () => {
                                        location.reload()
                                    }
                                }).then(() => {
                                    location.reload();
                                })
                            })
                        }

                    </script>


                </div>
            </div>
        </div>  
        

        <div class="col-md-8">
            <div class="card mb-5 shadow">
                <div class="card-header">
                    User Insight
                </div>
                <div class="card-body">

                    <canvas id="myChart" width="400" height="200"></canvas>
                    <script>
                        let url = "{{ route('movieGetDataX') }}";
                        console.log(url);
                        fetch(url).then(response => response.json())
                        .then((data) => {
                            console.log(data)
                            let labels = [];
                            for (let index = 1; index < 11; index++) {
                                labels.push(index);
                            }  
                            let ratings = [];
                            for (let index = 1; index < 11; index++) {
                                ratings.push(data[index]);                                
                            }                     
                            const ctx = document.getElementById('myChart').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Movie data insight by rating',
                                        data: ratings,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        
                        })

 
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

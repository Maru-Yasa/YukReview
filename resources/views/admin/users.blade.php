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
            <div class="card mb-5 shadow">
                <div class="card-header">
                    All Users
                </div>
                <div class="card-body">

                    <table id="userTable" class="table">
                        <thead class="border-0 bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('userEdit', ['id'=>$user->id]) }}"><i class="bi bi-pencil-fill"></i></a>
                                        <a class="btn btn-outline-danger btn-sm" href="{{ route('userDelete', ['id' => $user->id]) }}"><i class="bi bi-trash-fill"></i></a>
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
            <div class="card mb-5 shadow">
                <div class="card-header">
                    User Insight
                </div>
                <div class="card-body">

                    <canvas id="myChart" width="400" height="200"></canvas>
                    <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Female', 'Male', 'Other'],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
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
                    </script>


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

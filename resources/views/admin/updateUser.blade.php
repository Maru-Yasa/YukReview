@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit User {{ $user->id }}
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
                    <form action="{{ route('updateUser') }}" method="POST">
                        @csrf
                        <input type="text" name="id" value="{{ $user->id }}" hidden>
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" value="{{ $user->name }}" class="form-control" name="name" id="name" aria-describedby="" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" id="gender">
                                <option selected value="{{ $user->gender }}">{{ $user->gender }}</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                          <label for="birth" class="form-label">Date of birth</label>
                          <input type="date" value="{{ $user->birth }}" class="form-control" name="birth" id="birth" aria-describedby="" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role" id="role">
                                <option selected value="{{ $user->role }}">{{ $user->role }}</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">Save</button>
                            <a href="/admin/users" class="btn btn-outline-danger"><i class="bi bi-box-arrow-left"></i> Back</a>
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

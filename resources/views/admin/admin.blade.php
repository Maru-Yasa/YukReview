@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/app.js') }}"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body text-center">
                    @if (Auth::user()->profile == null)
                        <i class="bi bi-person-circle" style="font-size: 100px"></i>
                    @else
                        <img class="rounded-circle img-thumbnail ratio ratio-1x1" src="{{ Auth::user()->profile }}" alt="" style="width: 100px;height:100px;object-fit:cover;">
                    @endif
                    <style>
                        
                    </style>
                    <br>
                    <span class="fs-2 fw-bold">Welcome <strong>{{ Auth::user()->name }}</strong></span>

                </div>
            </div>
        </div>

        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-header">Edit Profile</div>

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
                    <form enctype="multipart/form-data" action="{{ route('updateProfile') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input value="{{ $user->name }}" type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">Password</label>
                          <input type="password" class="form-control" name="" id="" placeholder="">
                          <small id="helpId" class="form-text text-muted">If you're not gonna change password don't fill it</small>
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
                          <label for="" class="form-label">Date of birth</label>
                          <input type="date" class="form-control" name="birth" id="" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="mb-3">
                          <label for="image" class="form-label">Profile picture</label>
                          <input type="file" class="form-control" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
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

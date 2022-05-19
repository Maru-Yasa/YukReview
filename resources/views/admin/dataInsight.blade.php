@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/app.js') }}"></script>

<div class="container">
    <div class="row justify-content-center">
        
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

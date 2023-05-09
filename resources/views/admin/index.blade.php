@extends('admin.layout')

@section('content')
    <div class="h-100vh d-flex justify-content-center align-items-center flex-column">
        <h1 class="display-5 fw-bold">Halo, Admin<br> {{ auth()->user()->name }}</h1>
    </div>
@endsection

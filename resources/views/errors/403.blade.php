@extends('layouts.error')
@section('content')
<div class="vh-100 vw-100 bg-light d-flex flex-column align-items-center p-4">
    <img src="/src/images/errors/403.svg" alt="" class="d-block w-100 mx-auto" style="max-width: 25em">
    <h2>Hey!! look at your position kid!!</h2>
    <a href="{{route('landing')}}" class="btn btn-outline-primary mt-2">Back to Home</a>
</div>
@endsection
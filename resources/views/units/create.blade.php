@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Unit</h2>
        <form method="POST" action="{{ route('units.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Unit Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Unit</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Unit</h2>
        <form method="POST" action="{{ route('units.update', $unit) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Unit Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $unit->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Unit</button>
        </form>
    </div>
@endsection
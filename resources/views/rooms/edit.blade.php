@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Room</h2>
        <form method="POST" action="{{ route('rooms.update', $room) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}" required>
            </div>

            <div class="mb-3">
                <label for="id_unit" class="form-label">Select Unit</label>
                <select class="form-control" id="id_unit" name="id_unit" required>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ $room->id_unit == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $room->capacity }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Room</button>
        </form>
    </div>
@endsection

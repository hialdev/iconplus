@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Room</h2>
        @if (Session::has('success'))
            <div class="alert alert-success mt-3">
                {{ Session::get('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('rooms.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasitas</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{old('capacity')}}" required>
            </div>

            <div class="mb-3">
                <label for="id_unit" class="form-label">Select Unit</label>
                <select class="form-control" id="id_unit" name="id_unit" value="{{old('id_unit')}}" required>
                    <option value="" selected>-- Select Unit --</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Room</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('check')}}" class="btn btn-light">< Kembali</a>
        <div class="p-5 d-flex align-items-center gap-5 bg-white">
            <h2>Kelola Ruangan</h2>
            <a href="{{route('rooms.create')}}" class="btn btn-primary btn-sm">Tambah</a>
        </div>
        <div class="p-5 d-flex align-items-center gap-5 bg-light rounded-3">
            <h2>Tambah Unit</h2>
            <a href="{{route('units.create')}}" class="btn btn-primary btn-sm">Tambah</a>
        </div>
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
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="container my-5">
        @foreach ($units as $unit)
        <div class="d-flex align-items-center gap-2">
            <h3>{{$unit->name}}</h3>
            <a href="{{route('units.edit',$unit)}}" class="btn btn-sm btn-light">Ubah</a>
            <form method="POST" action="{{route('units.destroy',$unit)}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">hapus</button>
            </form>
        </div>
        <div class="row align-items-stretch mb-4">
            @forelse ($unit->rooms as $room)
            <div class="p-3 col-6 col-md-4 col-lg-3">
                <div class="p-3 rounded-3 border">
                    <div class="mb-2 d-flex align-items-center gap-3">
                        <img src="/src/images/illustration/meet (4).svg" alt="Room Illustration" class="d-block" style="height: 3em; object-fit:contain">
                        <h3 class="fs-6 fs-md-5 m-0">{{$room->name}}</h3>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{route('rooms.edit',$room)}}" class="btn btn-sm btn-light">Ubah</a>
                        <form method="POST" action="{{route('rooms.destroy',$room)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-5 mb-3 rounded-3 text-secondary">
                Tidak ada Data Ruangan
            </div>
            @endforelse
            
        </div>
        @endforeach
    </div>

@endsection

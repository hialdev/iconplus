{{-- dalam file resources/views/dashboard/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <h3 class="fs-4 mt-4"><span class="text-primary"># </span>Ruang sedang terpakai</h3>
        <div class="row my-4">
            @foreach ($units as $unit)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="p-3 rounded-3 border">
                    <h2 class="fs-5">{{$unit->name}}</h2>
                    <div class="mb-2 d-flex align-items-center gap-3">
                        <img src="/src/images/illustration/meet (4).svg" alt="Room Illustration" class="d-block" style="height: 3em; object-fit:contain">
                        <h3 class="fs-6 mb-0"><span class="fs-4 fw-bold">{{ $unit->usedRoomsCount->first()->used_rooms_count ?? 0 }}</span> Ruang Terpakai</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h3 class="fs-4 mt-4"><span class="text-primary"># </span>Ruang di booking</h3>
        <div class="row my-4">
            @foreach ($units as $unit)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="p-3 rounded-3 border">
                    <h2 class="fs-5">{{$unit->name}}</h2>
                    <div class="mb-2 d-flex align-items-center gap-3">
                        <img src="/src/images/illustration/meet (4).svg" alt="Room Illustration" class="d-block" style="height: 3em; object-fit:contain">
                        <h3 class="fs-6 mb-0"><span class="fs-4 fw-bold">{{ $unit->upcomingRoomsCount->first()->upcoming_rooms_count ?? 0 }}</span> Menunggu</h3>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>

        <h3 class="fs-4 mt-4"><span class="text-primary"># </span>Kapasitas yang terpakai (%)</h3>
        <div class="row">
            @foreach ($units as $unit)
            <div class="col-12 col-md-6 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-1">{{$unit->name}}</div>
                    <span class="text-secondary">{{$unit->totalParticipants()}}/{{$unit->totalCapacity()}} ({{$unit->calculateOccupancyPercentage()}}%)</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$unit->calculateOccupancyPercentage()}}%" aria-valuenow="{{$unit->calculateOccupancyPercentage()}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
@endsection

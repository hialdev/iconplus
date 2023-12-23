@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('check')}}" class="btn btn-light">< Kembali</a>
        <div class="p-5 bg-white">
            <h2>Ruangan yang tersedia</h2>
            <form method="GET" action="{{ route('check.available') }}">
                <div class="mb-3">
                    <label for="check_date" class="form-label">Masukan Tanggal yang ingin dicek</label>
                    <input type="date" class="form-control" id="check_date" name="check_date" required value="{{$checkDate}}">
                </div>

                <button type="submit" class="btn btn-primary">Cek Tanggal</button>
            </form>
        </div>
        @if(isset($availableRooms) || isset($bookedSlots))
            <h3 class="mt-4">Available Rooms</h3>
            @if(count($availableRooms) > 0)
                <ul class="list-group">
                    @foreach($availableRooms as $room)
                        <li class="list-group-item">{{ $room }}</li>
                    @endforeach
                </ul>
            @else
                <p>No available rooms on the selected date.</p>
            @endif

            <h3 class="mt-4">Booked Slots</h3>
            @if(count($bookedSlots) > 0)
                <ul class="list-group">
                    @foreach($bookedSlots as $booking)
                        <li class="list-group-item">
                            {{ $booking->room_name }} -
                            {{ $booking->start_time }} to {{ $booking->end_time }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No booked slots on the selected date.</p>
            @endif
        @endif
    </div>

    <div class="container my-5">
        @foreach ($units as $unit)
        <h2>{{$unit->name}}</h2>
        <div class="row align-items-stretch">
            @forelse ($unit->rooms as $room)
            <div class="p-3 col-6 col-md-4 col-lg-3">
                <div class="p-3 rounded-3 border">
                    <div class="mb-2 d-flex align-items-center gap-3">
                        <img src="/src/images/illustration/meet (4).svg" alt="Room Illustration" class="d-block" style="height: 3em; object-fit:contain">
                        <h3 class="fs-5">{{$room->name}}</h3>
                    </div>
                    <ul>Jam tersedia
                        @if (count($room->getAvailable($checkDate)) > 0)
                            @foreach ($room->getAvailable($checkDate) as $available)
                                <li class="p-2 px-3">{{$available['start_time']}} - {{$available['end_time']}}</li>
                            @endforeach
                        @else
                            <li class="badge bg-primary">Semua jam</li>
                        @endif
                    </ul>
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

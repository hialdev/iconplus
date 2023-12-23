@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <img src="/src/images/illustration/meet (2).svg" alt="" class="d-block" style="max-height: 30em">
            </div>
            <div class="col-12 col-md-6">
                <div class="p-5 bg-white">
                    <h2>Check Ketersediaan Ruangan</h2>
                    <form method="GET" action="{{ route('check.available') }}">
                        <div class="mb-3">
                            <label for="check_date" class="form-label">Masukan Tanggal yang ingin dicek</label>
                            <input type="date" class="form-control" id="check_date" name="check_date" required>
                        </div>
        
                        <button type="submit" class="btn btn-primary">Cek Tanggal</button>
                    </form>
                </div>
            </div>
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

@endsection

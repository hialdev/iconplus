<!-- dalam file resources/views/pages/order.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h2>Order Meeting Room</h2>
                <form method="POST" action="{{ route('order') }}">
                    @csrf
                    @if (Session::has('success'))
                        <div class="alert alert-success mt-3">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger mt-3">
                            {{ Session::get('error') }}
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
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit PLN</label>
                        <select class="form-control" id="unit" name="unit" required>
                            <option value="" selected>-- Select Unit --</option>
                            <!-- Populate units dynamically using JSON data -->
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="room_name" class="form-label">Room Meeting</label>
                        <select class="form-control" id="room" name="room" required>
                            <option value="" selected>-- Select Room --</option>
                            <!-- Populate rooms dynamically using JSON data -->
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="date_meeting" class="form-label">Meeting Date</label>
                        <input type="date" class="form-control" id="date_meeting" name="date_meeting" required>
                    </div>

                    <div id="available_hours_info" class="mb-3">
                        
                    </div>
        
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" required>
                        <span id="time-error" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="participants" class="form-label">Number of Participants</label>
                        <input type="number" class="form-control" id="participants" name="participants" required>
                    </div>

                    <div class="mb-3">
                        <label for="consumption_type" class="form-label">Consumption Type</label>
                        <select class="form-control" id="consumption_type" name="consumption_type" required>
                            <option value="" selected>-- Select Konsumsi --</option>
                            @foreach ($consumptions as $consume)
                            <option value="{{$consume->id}}">{{$consume->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Pesan Ruangan</button>
                </form>
            </div>

            <div class="col-12 col-lg-6 order-first">
                <img src="/src/images/illustration/meet (4).svg" alt="" class="d-block w-100 position-sticky top-0">
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch units and populate the unit select options
        fetch('/json/units')
            .then(response => response.json())
            .then(data => {
                const unitSelect = document.getElementById('unit');
                unitSelect.innerHTML = '<option value="" selected>-- Select Unit --</option>';
                data.forEach(unit => {
                    unitSelect.innerHTML += `<option value="${unit.id}">${unit.name}</option>`;
                });
            });

        // Handle unit selection to dynamically populate rooms
        document.getElementById('unit').addEventListener('change', function () {
            const selectedUnit = this.value;
            const roomSelect = document.getElementById('room');

            // Fetch rooms for the selected unit
            fetch(`/json/rooms/unit/${selectedUnit}`)
                .then(response => response.json())
                .then(data => {
                    roomSelect.innerHTML = '<option value="" selected>-- Select Room --</option>';
                    data.forEach(room => {
                        roomSelect.innerHTML += `<option value="${room.id}">${room.name}</option>`;
                    });
                });
        });

        // Add logic to get available hours when date is changed
        // Function to fetch and display available hours
        function fetchAndDisplayAvailableHours() {
            const selectedDate = document.getElementById('date_meeting').value;
            const roomId = document.getElementById('room').value;

            // Fetch endpoint to get available hours for the selected date and room
            fetch(`/json/rooms/${roomId}?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    availableHours = data.available;

                    // Display available hours information to the user
                    const availableHoursInfo = document.getElementById('available_hours_info');

                    // Create an unordered list (ul) to display the available hours
                    const ul = document.createElement('ul');

                    // Populate the list items (li) with the available hours
                    availableHours.forEach(hour => {
                        // Format jam dalam format yang diinginkan
                        const formattedHour = `${hour.start_time} - ${hour.end_time}`;

                        const li = document.createElement('li');
                        li.textContent = formattedHour;
                        ul.appendChild(li);
                    });

                    // Replace the content of the available_hours_info div with the ul
                    if (availableHours.length > 0) {
                        availableHoursInfo.innerHTML = 'Available Hours:';
                    } else {
                        availableHoursInfo.innerHTML = 'Semua jam tersedia';
                    }
                    availableHoursInfo.appendChild(ul);
                });
        }

        // Event listener for date change
        document.getElementById('date_meeting').addEventListener('change', fetchAndDisplayAvailableHours);

        // Event listener for room change
        document.getElementById('room').addEventListener('change', fetchAndDisplayAvailableHours);

        // Add logic to check if the selected time is available
        document.getElementById('start_time').addEventListener('change', checkTimeAvailability);
        document.getElementById('end_time').addEventListener('change', checkTimeAvailability);

        function checkTimeAvailability() {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            const meetingDate = document.getElementById('date_meeting').value;
            const roomId = document.getElementById('room').value;

            // Fetch endpoint to check if the selected time is booked
            fetch(`/json/rooms/${roomId}/check?date=${meetingDate}&start=${startTime}&end=${endTime}`)
                .then(response => response.json())
                .then(data => {
                    const timeError = document.getElementById('time-error');
                    console.log(data);
                    if (data === true) {
                        timeError.textContent = 'Selected time is not available. Please choose a different time.';
                    } else {
                        timeError.textContent = '';
                    }
                });
        }
        
    });

    var konsumsiOptions = @json($consumptions);

    function updateConsumptionType() {
        var meetingStartTime = document.getElementById('start_time').value;
        var meetingEndTime = document.getElementById('end_time').value;
        var consumptionTypeSelect = document.getElementById('consumption_type');

        // Validasi end_time < start_time
        if (meetingEndTime < meetingStartTime) {
            document.getElementById('end_time').value = meetingStartTime;
            meetingEndTime = meetingStartTime;
        }

        // Condition Logic Jenis Konsumsi
        var selectedOption = konsumsiOptions.find(function (konsumsi) {
            if (meetingStartTime < '11:00') {
                return konsumsi.id == 1;
            } else if (meetingStartTime >= '11:00' && meetingEndTime <= '14:00') {
                return konsumsi.id == 2;
            } else if (meetingStartTime > '14:00'){
                return konsumsi.id == 3;
            }
        });

        if (selectedOption) {
            consumptionTypeSelect.value = selectedOption.id;
        }
    }

    document.getElementById('start_time').addEventListener('change', updateConsumptionType);
    document.getElementById('end_time').addEventListener('change', updateConsumptionType);

    updateConsumptionType();
</script>
@endsection


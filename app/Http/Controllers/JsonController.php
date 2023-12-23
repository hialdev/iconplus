<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Unit;
use Illuminate\Http\Request;

class JsonController extends Controller
{

    public function rooms()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    public function roomByUnit($id_unit)
    {
        $unit = Unit::find($id_unit);
        $rooms = $unit->rooms;
        return response()->json($rooms);
    }

    public function units()
    {
        $units = Unit::all();
        return response()->json($units);
    }

    public function roomFind($id_room, Request $req)
    {
        $room = Room::find($id_room);
        
        $date = $req->get('date');
        
        if ($date !== ''){
            $room = [
                'room' => $room,
                'available' => $room->getAvailable($date),
            ];
        }

        return response()->json($room);
    }

    public function roomsAvailableCheck(Request $request)
    {
        $request->validate([
            'id_unit' => 'required|exists:units,id',
            'date' => 'required|date_format:Y-m-d',
        ]);

        $unitId = $request->input('unit_id');
        $date = $request->input('date');

        $unitId = 1;
        $date = '2023-12-22';

        // Mendapatkan ruangan yang tersedia pada tanggal tertentu untuk unit yang dipilih
        $rooms = Room::where('id_unit', $unitId)
            ->get();
        dd($rooms);
        $availableRooms = [];

        foreach ($rooms as $room) {
            $isBooked = $room->isBooked($date, '00:00:00', '23:59:59');
            if (!$isBooked) {
                $availableRooms[] = [
                    'id' => $room->id,
                    'name' => $room->name,
                ];
            }
        }

        return response()->json($availableRooms);
    }

    public function checkBooked($id_room, Request $req)
    {
        $date = $req->get('date');
        $start_hour = $req->get('start');
        $end_hour = $req->get('end');

        $room = Room::find($id_room);
        $isBooked = $room->isBooked($date, $start_hour, $end_hour);
        return response()->json($isBooked);
    }

}

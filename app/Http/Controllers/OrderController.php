<?php

namespace App\Http\Controllers;

use App\Models\Konsumsi;
use App\Models\Pesanan;
use App\Models\Room;
use App\Models\Unit;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        $units = Unit::all();
        $consumptions = Konsumsi::all();
        $rooms = Room::all();
        return view('order', compact('rooms','units','consumptions'));
    }

    public function orderSend(Request $request)
    {
        $request->validate([
            'unit' => 'required',
            'room' => 'required|exists:rooms,id',
            'date_meeting' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'participants' => 'required|integer',
            'consumption_type' => 'required|exists:konsumsis,id',
            'keterangan' => 'required',
        ]);

        $room = Room::find($request->room);
        if (!$room->isBooked($request->date_meeting, $request->start_time, $request->end_time)) {
            Pesanan::create([
                'id_user' => auth()->id(),
                'id_room' => $request->room,
                'date_meeting' => $request->date_meeting,
                'hour_start' => $request->start_time,
                'hour_end' => $request->end_time,
                'total_participants' => $request->participants,
                'id_konsumsi' => $request->consumption_type,
                'id_status' => 1, 
                'keterangan' => $request->keterangan,
            ]);
    
            return redirect()->route('order')->with('success', 'Pesanan berhasil dikirim!');
        }else{
            return redirect()->route('order')->with('error', 'Pemesanan bentrok! perhatikan jam tersedia');
        }
        
    }

}

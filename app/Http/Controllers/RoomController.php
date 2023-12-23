<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {   
        $units = Unit::all();
        $rooms = Room::all();
        return view('rooms.index', compact('rooms','units'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('rooms.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_unit' => [
                'required',
                'exists:units,id'
            ],
            'capacity' => 'required|numeric'
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $units = Unit::all();
        return view('rooms.edit', compact('room', 'units'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_unit' => [
                'required',
                'exists:units,id',
            ],
            'capacity' => 'required|numeric',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }
}

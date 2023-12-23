<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Unit::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Unit created successfully');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $unit->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Unit updated successfully');
    }

    public function destroy(Unit $unit)
    {
        if (!count($unit->rooms) > 0) {
            $unit->delete();
            return redirect()->route('rooms.index')->with('success', 'Unit deleted successfully');
        }

        return redirect()->route('rooms.index')->with('error', 'Unit cannot be deleted because it has associated rooms, Delete All Rooms First');
    }
}

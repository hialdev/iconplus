<?php

namespace App\Http\Controllers;

use App\Models\Konsumsi;
use App\Models\Pesanan;
use App\Models\Room;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function checkAvailable()
    {
        return view('check_availability');
    }

    public function getAvailable(Request $request)
    {
        // Validasi input form
        $request->validate([
            'check_date' => 'required|date',
        ]);

        // Ambil data dari request
        $checkDate = $request->input('check_date');

        $units = Unit::all();
        
        return view('check_detail', compact('units','checkDate'));
    }
}

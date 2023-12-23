<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_unit');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id_unit');
    }

    public function orders()
    {
        return $this->hasMany(Pesanan::class, 'id_unit', 'id');
    }

    public function usedRoomsCount()
    {
        return $this->rooms()
            ->selectRaw('id_unit, COUNT(*) as used_rooms_count')
            ->leftJoin('pesanans', function ($join) {
                $join->on('rooms.id', '=', 'pesanans.id_room')
                    ->where('date_meeting', '>=', now()->toDateString())
                    ->where('date_meeting', '<=', now()->addDay()->toDateString());
            })
            ->groupBy('id_unit');
    }

    public function upcomingRoomsCount()
    {
        return $this->rooms()
            ->selectRaw('id_unit, COUNT(*) as upcoming_rooms_count')
            ->leftJoin('pesanans', function ($join) {
                $join->on('rooms.id', '=', 'pesanans.id_room')
                    ->where('date_meeting', '>=', now()->addDay()->toDateString())
                    ->where('date_meeting', '<=', now()->addDays(2)->toDateString());
            })
            ->groupBy('id_unit');
    }

    // Fungsi untuk mendapatkan total kapasitas dari semua ruangan per unit
    public function totalCapacity()
    {
        return $this->rooms()->sum('capacity');
    }

    // Fungsi untuk mendapatkan total partisipan dari semua pesanan per unit untuk rentang waktu yang ditentukan
    public function totalParticipants()
    {
        return $this->rooms()
            ->join('pesanans', 'rooms.id', '=', 'pesanans.id_room')
            ->where('date_meeting', '>=', now()->toDateString())
            ->where('date_meeting', '<=', now()->addDays(2)->toDateString())
            ->sum('total_participants');
    }

    // Fungsi untuk mengolah total kapasitas dan total partisipan menjadi persentase
    public function calculateOccupancyPercentage()
    {
        $totalCapacity = $this->totalCapacity();
        $totalParticipants = $this->totalParticipants();

        $percentage = ($totalCapacity > 0) ? (($totalParticipants / $totalCapacity) * 100) : 0;

        return number_format($percentage, 2);
    }
}

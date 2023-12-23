<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['id_unit', 'name', 'capacity'];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }

    public function orders()
    {
        return $this->hasMany(Pesanan::class, 'id_unit', 'id_unit');
    }

    
    // Fungsi untuk menghitung total partisipan dalam persentase per unit
    public static function calculateParticipantPercentageByUnit()
    {
        return static::select('id_unit', 'capacity')
            ->withCount(['orders as total_participants' => function ($query) {
                $query->select(DB::raw('coalesce(sum(participants), 0)'));
            }])
            ->get();
    }

    public function isBooked($checkDate, $startHour, $endHour)
    {
        // Periksa apakah ruangan sudah dipesan pada rentang waktu tertentu
        $isBooked = Pesanan::where('id_room', $this->id)
            ->where('date_meeting', $checkDate)
            ->where(function ($query) use ($startHour, $endHour) {
                $query->whereBetween('hour_start', [$startHour, $endHour])
                    ->orWhereBetween('hour_end', [$startHour, $endHour])
                    ->orWhere(function ($q) use ($startHour, $endHour) {
                        $q->where('hour_start', '<=', $startHour)
                            ->where('hour_end', '>=', $endHour);
                    });
            })
            ->exists();

        return $isBooked;
    }

    public function getAvailable($checkDate)
    {
        // Ambil semua pesanan di ruangan pada tanggal tertentu
        $bookedSlots = Pesanan::where('id_room', $this->id)
            ->where('date_meeting', $checkDate)
            ->orderBy('hour_start')
            ->get();

        // Identifikasi ruangan yang tersedia
        $availableSlots = [];
        
        // Menentukan interval waktu yang masih tersedia
        foreach ($bookedSlots as $index => $booking) {
            if ($index === 0) {
                // Jika ini adalah pesanan pertama, cek waktu sebelumnya
                $start_time = '00:00:00';
            } else {
                // Jika ini bukan pesanan pertama, cek waktu sebelumnya dan waktu pesanan sebelumnya
                $start_time = $bookedSlots[$index - 1]->hour_end;
            }

            $end_time = $booking->hour_start;

            if (Carbon::parse($end_time)->gt(Carbon::parse($start_time))) {
                // Tambahkan interval waktu yang tersedia
                $availableSlots[] = [
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                ];
            }
        }

        // Cek interval waktu setelah pesanan terakhir
        $lastBooking = $bookedSlots->last();
        if ($lastBooking && Carbon::parse($lastBooking->hour_end)->lt(Carbon::parse('23:59:59'))) {
            $availableSlots[] = [
                'start_time' => $lastBooking->hour_end,
                'end_time' => '23:59:59',
            ];
        }

        return $availableSlots;
    }
}

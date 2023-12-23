<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_room',
        'name_meeting',
        'date_meeting',
        'hour_start',
        'hour_end',
        'total_participants',
        'id_konsumsi',
        'id_status',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function konsumsi()
    {
        return $this->hasOne(Konsumsi::class, 'id_konsumsi');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}

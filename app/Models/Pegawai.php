<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'NIP', 'nama'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

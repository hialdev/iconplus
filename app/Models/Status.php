<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_status');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    // Menambahkan 'user_id' di $fillable
    protected $fillable = [
        'jenis', 'nama', 'nim', 'program_studi', 'instansi_tujuan', 'judul_penelitian', 'user_id'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

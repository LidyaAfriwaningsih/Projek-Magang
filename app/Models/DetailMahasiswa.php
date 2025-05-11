<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'detail_mahasiswa'; // opsional jika nama sesuai konvensi

    protected $fillable = [
        'pengajuan_id',
        'nama',
        'nim',
        'program_studi',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'id');
    }
}

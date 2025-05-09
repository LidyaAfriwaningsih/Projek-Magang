<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'nama',
        'nim',
        'program_studi',
        'instansi_tujuan',
        'judul_penelitian',
        'user_id',
        'surat_dari',
        'nomor_surat',
        'tanggal_surat',
        'tempat_tanggal_lahir',
        'pekerjaan',
        'alamat',
        'nomor_identifikasi',
        'tanggal_penelitian',
        'file_ktp',
        'file_surat_dari',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
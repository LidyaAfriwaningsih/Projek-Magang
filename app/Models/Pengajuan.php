<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailMahasiswa;


class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'nama',
        'nim',
        'nomor_identitas',
        'program_studi',
        'instansi_tujuan',
        'judul_penelitian',
        'user_id',
        'surat_dari',
        'nomor_surat',
        'hal_surat',
        'tanggal_surat',
        'tanggal_mulai',
        'tanggal_selesai',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'alamat',
        'nomor_identifikasi',
        'file_ktp',
        'file_surat_dari',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tambahkan relasi ke tabel detail_mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(DetailMahasiswa::class, 'pengajuan_id', 'id');
    }
}

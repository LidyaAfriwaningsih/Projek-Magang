<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Http\Controllers\PengajuanController;
use Barryvdh\DomPDF\Facade\PDF;

class PengajuanController extends Controller
{
    // Tampilkan form pengajuan magang
    public function magang()
    {
        return view('admin.pengajuan.magang.magang');
    }

    // Simpan data pengajuan magang
    public function storeMagang(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'program_studi' => 'required|string|max:100',
            'instansi_tujuan' => 'required|string|max:255',
        ]);

        Pengajuan::create([
            'jenis' => 'magang',
            'nama' => $request->nama,
            'nim' => $request->nim,
            'program_studi' => $request->program_studi,
            'instansi_tujuan' => $request->instansi_tujuan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('pengajuan.magang')->with('success', 'Pengajuan magang berhasil dikirim.');
    }



    // Tampilkan form pengajuan penelitian
    public function penelitian()
    {
        return view('admin.pengajuan.penelitian.penelitian');
    }

    // Simpan data pengajuan penelitian
    public function storePenelitian(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'program_studi' => 'required|string|max:100',
            'judul_penelitian' => 'required|string|max:255',
        ]);

        Pengajuan::create([
            'jenis' => 'penelitian',
            'nama' => $request->nama,
            'nim' => $request->nim,
            'program_studi' => $request->program_studi,
            'judul_penelitian' => $request->judul_penelitian,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('pengajuan.penelitian')->with('success', 'Pengajuan penelitian berhasil dikirim.');
    }

    
    // ADMIN: Tampilkan semua pengajuan magang
    public function indexMagang()
    {
        $pengajuanMagang = Pengajuan::where('jenis', 'magang')->with('user')->get();
        return view('admin.pengajuan.magang.index', compact('pengajuanMagang'));
    }

    // ADMIN: Tampilkan semua pengajuan penelitian
    public function indexPenelitian()
    {
        $pengajuanPenelitian = Pengajuan::where('jenis', 'penelitian')->with('user')->get();
        return view('admin.pengajuan.penelitian.index', compact('pengajuanPenelitian'));
    }

    // ADMIN: Tampilkan detail pengajuan magang
    public function showMagang($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        return view('admin.pengajuan.magang.show', compact('pengajuan'));
    }

    // ADMIN: Tampilkan detail pengajuan penelitian
    public function showPenelitian($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        return view('admin.pengajuan.penelitian.show', compact('pengajuan'));
    }

    // ADMIN: Proses pengajuan magang
    public function prosesMagang($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'diproses'; // pastikan kolom 'status' ada di tabel
        $pengajuan->save();
       // dd("dasdad");
        return redirect()->route('admin.magang.index')->with('success', 'Pengajuan magang telah diproses.');
    }

    // ADMIN: Proses pengajuan penelitian
    public function prosesPenelitian($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'diproses'; // pastikan kolom 'status' ada di tabel
        $pengajuan->save();
       
        return redirect()->route('admin.penelitian.index')->with('success', 'Pengajuan penelitian telah diproses.');
    }

     // ✅ ADMIN: Cetak surat pengajuan magang
     public function cetakMagang($id)
     {
         // Ambil data pengajuan dengan relasi ke user (misal: mahasiswa yang mengajukan)
         $pengajuan = Pengajuan::with('user')->findOrFail($id);
         
         // Menggunakan PDF untuk mencetak surat pengajuan magang
         $pdf = PDF::loadView('admin.pengajuan.magang.cetak', compact('pengajuan'));
         
         // Menyediakan file PDF untuk diunduh dengan nama yang sesuai
         return $pdf->download('Pengajuan-Magang-'.$pengajuan->user->nama.'.pdf');
         
         // Versi PDF lain bisa disediakan, sesuaikan jika diperlukan
         // $pdf = PDF::loadView('admin.pengajuan.magang.cetak', compact('pengajuan'));
         // return $pdf->download('Surat_Pengajuan_Magang.pdf');
     }

      // ✅ ADMIN: Cetak surat pengajuan penelitian
    public function cetakPenelitian($id)
    {
        // Ambil data pengajuan dengan relasi ke user (misal: mahasiswa yang mengajukan)
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        
        // Menggunakan PDF untuk mencetak surat pengajuan magang
        $pdf = PDF::loadView('admin.pengajuan.penelitian.cetak', compact('pengajuan'));
        
        // Menyediakan file PDF untuk diunduh dengan nama yang sesuai
        return $pdf->download('Pengajuan-Penelitian-'.$pengajuan->user->nama.'.pdf');
        
        // Versi PDF lain bisa disediakan, sesuaikan jika diperlukan
        // $pdf = PDF::loadView('admin.pengajuan.magang.cetak', compact('pengajuan'));
        // return $pdf->download('Surat_Pengajuan_Magang.pdf');
    }
}

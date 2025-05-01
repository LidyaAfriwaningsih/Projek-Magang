<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

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

        return redirect()->route('pengajuan.admin.magang.index')->with('success', 'Pengajuan magang telah diproses.');
    }

    // ADMIN: Proses pengajuan penelitian
    public function prosesPenelitian($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'diproses'; // pastikan kolom 'status' ada di tabel
        $pengajuan->save();

        return redirect()->route('pengajuan.admin.penelitian.index')->with('success', 'Pengajuan penelitian telah diproses.');
    }
}

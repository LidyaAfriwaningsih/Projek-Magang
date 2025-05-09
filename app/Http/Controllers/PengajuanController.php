<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Http\Controllers\PengajuanController;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    // Tampilkan form pengajuan magang
    public function magang()
    {
        return view('admin.pengajuan.magang.magang');
    }

    // Simpan data pengajuan magang (kelompok)
    public function storeMagang(Request $request)
    {
        // Validasi form input
        $request->validate([
            'nama.*' => 'required|string|max:255',
            'nim.*' => 'required|string|max:20|regex:/^[0-9]+$/',
            'program_studi.*' => 'required|string|max:100',
            'instansi_tujuan' => 'required|string|max:255',
            'surat_dari' => 'nullable|string|max:255',
            'nomor_surat' => 'nullable|string|max:100',
            'tanggal_surat' => 'nullable|date',
            'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_surat_dari' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ], [
            'nama.*.required' => 'Nama mahasiswa harus diisi',
            'nim.*.required' => 'NIM mahasiswa harus diisi',
            'nim.*.regex' => 'NIM hanya boleh berisi angka',
            'program_studi.*.required' => 'Program studi mahasiswa harus diisi',
            'instansi_tujuan.required' => 'Instansi tujuan magang harus diisi',
            'file_ktp.required' => 'File KTP harus diupload',
            'file_surat_dari.required' => 'File surat dari kampus harus diupload',
            'file_ktp.mimes' => 'File KTP harus berupa JPG, JPEG, PNG atau PDF',
            'file_surat_dari.mimes' => 'File surat harus berupa JPG, JPEG, PNG atau PDF',
            'file_ktp.max' => 'Ukuran file KTP maksimal 2MB',
            'file_surat_dari.max' => 'Ukuran file surat maksimal 2MB'
        ]);

        try {
            // Upload file
            $fileKtpPath = $request->file('file_ktp')->store('pengajuan/ktp', 'public');
            $fileSuratPath = $request->file('file_surat_dari')->store('pengajuan/surat', 'public');

            $kelompokId = 'KLMPK-' . date('Ymd') . '-' . substr(uniqid(), -5);

            // Simpan data pengajuan untuk setiap anggota kelompok
            foreach ($request->nama as $key => $value) {
                Pengajuan::create([
                    'jenis' => 'magang',
                    'nama' => $value,
                    'nim' => $request->nim[$key],
                    'program_studi' => $request->program_studi[$key],
                    'instansi_tujuan' => $request->instansi_tujuan,
                    'surat_dari' => $request->surat_dari,
                    'nomor_surat' => $request->nomor_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'user_id' => auth()->id(),
                    'status' => 'diajukan',
                    'file_ktp' => $fileKtpPath,
                    'file_surat_dari' => $fileSuratPath,
                    'kelompok_id' => $kelompokId
                ]);
            }

            return redirect()->route('pengajuan.magang')
                ->with('success', 'Pengajuan magang berhasil dikirim!');

        } catch (\Exception $e) {
            // Hapus file yang sudah terupload jika ada error
            if (isset($fileKtpPath)) {
                Storage::disk('public')->delete($fileKtpPath);
            }
            if (isset($fileSuratPath)) {
                Storage::disk('public')->delete($fileSuratPath);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Tampilkan form pengajuan penelitian
    public function penelitian()
    {
        return view('admin.pengajuan.penelitian.penelitian');
    }

    public function storePenelitian(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'nomor_identifikasi' => 'required|string|max:100',
            'judul_penelitian' => 'required|string|max:255',
            'untuk' => 'required|string|max:255',
            'file_identitas' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_proposal' => 'required|file|mimes:pdf|max:5120'
        ], [
            'file_identitas.required' => 'File identitas harus diupload',
            'file_proposal.required' => 'File proposal penelitian harus diupload',
            'file_proposal.mimes' => 'File proposal harus berupa PDF',
            'file_proposal.max' => 'Ukuran file proposal maksimal 5MB'
        ]);

        try {
            $fileIdentitasPath = $request->file('file_identitas')->store('penelitian/identitas', 'public');
            $fileProposalPath = $request->file('file_proposal')->store('penelitian/proposal', 'public');

            Pengajuan::create([
                'jenis' => 'penelitian',
                'nama' => $request->nama,
                'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'nomor_identifikasi' => $request->nomor_identifikasi,
                'judul_penelitian' => $request->judul_penelitian,
                'untuk' => $request->untuk,
                'user_id' => auth()->id(),
                'status' => 'diajukan',
                'file_ktp' => $fileIdentitasPath,
                'file_surat_dari' => $fileProposalPath
            ]);

            return redirect()->route('pengajuan.penelitian')
                ->with('success', 'Pengajuan penelitian berhasil dikirim!');

        } catch (\Exception $e) {
            if (isset($fileIdentitasPath)) {
                Storage::disk('public')->delete($fileIdentitasPath);
            }
            if (isset($fileProposalPath)) {
                Storage::disk('public')->delete($fileProposalPath);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengirim pengajuan: ' . $e->getMessage());
        }
    }

    public function indexMagang()
    {
        $pengajuanMagang = Pengajuan::where('jenis', 'magang')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('kelompok_id');

        return view('admin.pengajuan.magang.index', compact('pengajuanMagang'));
    }

    public function indexPenelitian()
    {
        $pengajuanPenelitian = Pengajuan::where('jenis', 'penelitian')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengajuan.penelitian.index', compact('pengajuanPenelitian'));
    }

    public function showMagang($kelompok_id)
    {
        $anggotaKelompok = Pengajuan::where('kelompok_id', $kelompok_id)
            ->with('user')
            ->get();

        if ($anggotaKelompok->isEmpty()) {
            abort(404);
        }

        return view('admin.pengajuan.magang.show', [
            'kelompok_id' => $kelompok_id,
            'anggota' => $anggotaKelompok,
            'dataUtama' => $anggotaKelompok->first()
        ]);
    }

    public function showPenelitian($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        return view('admin.pengajuan.penelitian.show', compact('pengajuan'));
    }

    public function prosesMagang($kelompok_id)
    {
        try {
            $affected = Pengajuan::where('kelompok_id', $kelompok_id)
                ->update(['status' => 'diproses']);

            if ($affected > 0) {
                return redirect()->route('pengajuan.admin.magang.index')
                    ->with('success', 'Status pengajuan magang telah diperbarui');
            }

            return redirect()->back()
                ->with('error', 'Tidak ada data pengajuan yang ditemukan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function prosesPenelitian($id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->status = 'diproses';
            $pengajuan->save();

            return redirect()->route('pengajuan.admin.penelitian.index')
                ->with('success', 'Status pengajuan penelitian telah diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function tolakPengajuan(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        try {
            $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->status = 'ditolak';
            $pengajuan->alasan_penolakan = $request->alasan_penolakan;
            $pengajuan->save();

            $route = $pengajuan->jenis === 'magang' 
                ? 'pengajuan.admin.magang.index' 
                : 'pengajuan.admin.penelitian.index';

            return redirect()->route($route)
                ->with('success', 'Pengajuan telah ditolak');
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menolak pengajuan: ' . $e->getMessage());
        }
    }    
     // ✅ ADMIN: Cetak surat pengajuan magang
     public function cetakMagang($id)
     {
         // Ambil data pengajuan dengan relasi ke user (misal: mahasiswa yang mengajukan)
         $pengajuan = Pengajuan::with('user')->findOrFail($id);
         $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');
         
         // Menggunakan PDF untuk mencetak surat pengajuan magang
         $pdf = PDF::loadView('admin.pengajuan.magang.cetak', [
            'pengajuan' => $pengajuan,
            'tanggalCetak' => $tanggalCetak
        ]);
         
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

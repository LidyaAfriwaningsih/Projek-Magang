<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  
use App\Models\Pengajuan;
use App\Http\Controllers\PengajuanController;
use App\Models\DetailMahasiswa;
use Barryvdh\DomPDF\Facade\PDF;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    // Tampilkan form pengajuan magang
    public function magang()
    {
        return view('admin.Pengajuan.Magang.magang');
    }

    // Simpan data pengajuan magang (kelompok)
    public function storeMagang(Request $request)
    {
        // Validasi form input
        $request->validate([
            'nama.*' => 'required|string|max:255',
            'nim.*' => 'required|string|max:20|regex:/^[0-9]+$/',
            'program_studi.*' => 'required|string|max:100',
            'instansi_tujuan.*' => 'required|string|max:255',
            'surat_dari.*' => 'required|string|max:255',
            'nomor_surat.*' => 'required|string|max:100',
            'hal_surat.*' => 'required|string|max:100',
            'tanggal_surat.*' => 'required|date',
            'tanggal_mulai.*' => 'required|date|before_or_equal:tanggal_selesai', // Validasi tanggal mulai
            'tanggal_selesai.*' => 'required|date|after_or_equal:tanggal_mulai', // Validasi tanggal selesai
            'file_ktp.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_surat_dari.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ], [
            'nama.*.required' => 'Nama mahasiswa harus diisi',
            'nim.*.required' => 'NIM mahasiswa harus diisi',
            'nim.*.regex' => 'NIM hanya boleh berisi angka',
            'program_studi.*.required' => 'Program studi mahasiswa harus diisi',
            'instansi_tujuan.required' => 'Instansi tujuan magang harus diisi',
            'surat_dari.required' => 'Surat dari harus diisi',
            'instansi_tujuan.required' => 'Instansi tujuan magang harus diisi',
            'surat_dari.*.required' => 'Surat dari harus diisi',
            'nomor_surat.*.required' => 'Nomor surat harus diisi',
            'hal_surat.*.required' => 'Hal surat harus diisi',
            'tanggal_surat.*.required' => 'Tanggal surat harus diisi',
            'tanggal_mulai.*.required' => 'Tanggal mulai harus diisi',
            'tanggal_selesai.*.required' => 'Tanggal selesai harus diisi',
            'file_ktp.required' => 'File KTP harus diupload',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_mulai.before_or_equal' => 'Tanggal mulai tidak boleh lebih dari tanggal selesai',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai',
            'file_ktp.mimes' => 'File KTP harus berupa JPG, JPEG, PNG atau PDF',
            'file_surat_dari.mimes' => 'File surat harus berupa JPG, JPEG, PNG atau PDF',
            'file_ktp.max' => 'Ukuran file KTP maksimal 2MB',
            'file_surat_dari.max' => 'Ukuran file surat maksimal 2MB'
        ]);

        try {
            // Upload file
            $fileKtpPath = $request->file('file_ktp')->store('pengajuan/ktp', 'public');
            $fileSuratPath = $request->file('file_surat_dari')->store('pengajuan/surat', 'public');

            // Membuat ID kelompok yang unik
            $kelompokId = 'KLMPK-' . date('Dmy') . '-' . substr(uniqid(), -5);

            // Simpan data pengajuan untuk setiap anggota kelompok
            foreach ($request->nama as $key => $value) {
                // Simpan data pengajuan untuk anggota
                $pengajuan = Pengajuan::create([
                    'jenis' => 'magang',
                    'nama' => $value,
                    'nim' => $request->nim[$key],
                    'program_studi' => $request->program_studi[$key],
                    'instansi_tujuan' => $request->instansi_tujuan,
                    'surat_dari' => $request->surat_dari,
                    'nomor_surat' => $request->nomor_surat,
                    'hal_surat' => $request->hal_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'user_id' => auth()->id(),
                    'status' => 'diajukan',
                    'file_ktp' => $fileKtpPath,
                    'file_surat_dari' => $fileSuratPath,
                    'kelompok_id' => $kelompokId,
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                ]);

                // Simpan anggota kelompok ke detail_mahasiswa
                DetailMahasiswa::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama' => $value,
                    'nim' => $request->nim[$key],
                    'program_studi' => $request->program_studi[$key],
                ]);

                \Log::info('Berhasil simpan pengajuan untuk: ' . $value);
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
            return view('admin.Pengajuan.Penelitian.penelitian');
        }
        public function storePenelitian(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama.*' => 'required|string|max:255',
            'nim.*' => 'required|string|max:16|regex:/^[0-9]+$/',
            'nomor_identitas.*' => 'required|string|max:16|regex:/^[0-9]+$/',
            'Pekerjaan.*' => 'required|string|max:50',
            'alamat.*' => 'required|string|max:255',
            'tempat_lahir.*' => 'required|string|max:50',
            'tanggal_lahir.*' => 'required|date',
            'instansi_tujuan.*' => 'required|string|max:255',
            'judul_penelitian.*' => 'required|string|max:255',
            'surat_dari.*' => 'required|string|max:255',
            'nomor_surat.*' => 'required|string|max:100',
            'hal_surat.*' => 'required|string|max:100',
            'tanggal_surat.*' => 'required|date',
            'tanggal_mulai.*' => 'required|date|before_or_equal:tanggal_selesai', // Validasi tanggal mulai
            'tanggal_selesai.*' => 'required|date|after_or_equal:tanggal_mulai', // Validasi tanggal selesai
            'file_ktp.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_surat_dari.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ], [
            'nama.*.required' => 'Nama mahasiswa harus diisi',
            'nomor_identitas.*.required' => 'Nomor identitas mahasiswa harus diisi',
            'nomor_identitas.*.regex' => 'Nomor identitas (KTP) hanya boleh berisi angka',
            'pekerjaan.*.required' => 'Pekerjaan harus diisi',
            'alamat.*.required' => 'Alamat harus diisi',
            'tempat_lahir.*.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.*.required' => 'Tanggal lahir harus diisi',
            'instansi_tujuan.required' => 'Instansi tujuan penelitian harus diisi',
            'judul_penelitian.*.required' => 'Judul penelitian harus diisi',
            'surat_dari.*.required' => 'Surat dari harus diisi',
            'nomor_surat.*.required' => 'Nomor surat harus diisi',
            'hal_surat.*.required' => 'Hal surat harus diisi',
            'tanggal_surat.*.required' => 'Tanggal surat harus diisi',
            'tanggal_mulai.*.required' => 'Tanggal mulai harus diisi',
            'tanggal_selesai.*.required' => 'Tanggal selesai harus diisi',
            'file_ktp.required' => 'File KTP harus diupload',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_mulai.before_or_equal' => 'Tanggal mulai tidak boleh lebih dari tanggal selesai',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai',
            'file_ktp.mimes' => 'File KTP harus berupa JPG, JPEG, PNG atau PDF',
            'file_surat_dari.mimes' => 'File surat harus berupa JPG, JPEG, PNG atau PDF',
            'file_ktp.max' => 'Ukuran file KTP maksimal 2MB',
            'file_surat_dari.max' => 'Ukuran file surat maksimal 2MB'
        ]);

        try {
            $fileKtpPath = $request->file('file_ktp')->store('pengajuan/ktp', 'public');
            $fileSuratPath = $request->file('file_surat_dari')->store('pengajuan/surat', 'public');

            // Simpan data pengajuan penelitian ke dalam database
            Pengajuan::create([
                'jenis' => 'penelitian',
                'nama' => $request->nama,
                'nim' => $request->nim,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'surat_dari' => $request->surat_dari,
                'hal_surat' => $request->hal_surat,
                'tanggal_surat' => $request->tanggal_surat,
                'nomor_surat' => $request->nomor_surat,
                'nomor_identitas' => $request->nomor_identitas,
                'judul_penelitian' => $request->judul_penelitian,
                'instansi_tujuan' => $request->instansi_tujuan,
                'user_id' => auth()->id(),
                'status' => 'diajukan',
                'file_ktp' => $fileKtpPath,
                'file_surat_dari' => $fileSuratPath,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            \Log::info('Berhasil simpan pengajuan penelitian untuk: ' . $request->nama);

            return redirect()->route('pengajuan.penelitian')
                ->with('success', 'Pengajuan penelitian berhasil dikirim!');

        } catch (\Exception $e) {
            // Hapus file yang sudah terupload jika ada error
            if (isset($fileIdentitasPath)) {
                Storage::disk('public')->delete($fileIdentitasPath);
            }
            if (isset($fileProposalPath)) {
                Storage::disk('public')->delete($fileProposalPath);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function indexMagang()
    {
        $pengajuanMagang = Pengajuan::where('jenis', 'magang')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('kelompok_id');

        return view('admin.Pengajuan.Magang.index', compact('pengajuanMagang'));
    }

    public function indexPenelitian()
    {
        $pengajuanPenelitian = Pengajuan::where('jenis', 'penelitian')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.Pengajuan.Penelitian.index', compact('pengajuanPenelitian'));
    }

    public function showMagang($id)
    {

        // Ambil data pengajuan dengan relasi ke mahasiswa
        $pengajuan = Pengajuan::with('user')->findOrFail($id);

        $pengajuan->tanggal_mulai = \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->format('d-m-Y');
        $pengajuan->tanggal_selesai = \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->format('d-m-Y');

        // Ambil kelompok_id dari data pengajuan
        $kelompokId = $pengajuan->kelompok_id;

        // Ambil anggota kelompok berdasarkan kelompok_id
        $anggotaKelompok = Pengajuan::where('kelompok_id', $kelompokId)
            ->with('user') // Mengambil relasi user untuk setiap anggota kelompok
            ->get();

        // Jika anggota kelompok tidak ada, tampilkan error
        if ($anggotaKelompok->isEmpty()) {
            abort(404); // Jika tidak ada anggota kelompok
        }

        // Kirimkan data ke view, termasuk data pengajuan dan anggota kelompok
        return view('admin.Pengajuan.Magang.show', [
            'pengajuan' => $pengajuan,          // Kirim data pengajuan
            'anggotaKelompok' => $anggotaKelompok, // Kirim anggota kelompok
        ]);
    }

    public function showPenelitian($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        return view('admin.Pengajuan.Penelitian.show', compact('pengajuan'));
    }

    public function prosesMagang($id)
    {
        try {
            $affected = Pengajuan::where('id', $id)
                ->update(['status' => 'diproses']);

            if ($affected > 0) {
                return redirect()->route('admin.magang.index')
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

            return redirect()->route('admin.penelitian.index')
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

    public function hapusMagang($id)
    {
        // Temukan pengajuan magang berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id);

        // Hapus pengajuan magang
        $pengajuan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.magang.index')->with('success', 'Pengajuan Magang berhasil dihapus');
    }

    public function hapusPenelitian($id)
    {
        // Temukan pengajuan penelitian berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id);

        // Hapus pengajuan penelitian
        $pengajuan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.penelitian.index')->with('success', 'Pengajuan Magang berhasil dihapus');
    }

    public function selesaiMagang($id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            // Cek apakah status saat ini adalah 'diproses'
            if ($pengajuan->status !== 'diproses') {
                return redirect()->back()
                    ->with('error', 'Hanya pengajuan yang berstatus "diproses" yang bisa diselesaikan.');
            }

            $pengajuan->status = 'selesai';
            $pengajuan->save();

            return redirect()->route('admin.magang.index')
                ->with('success', 'Status pengajuan penelitian telah diperbarui menjadi selesai.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function selesaiPenelitian($id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            // Cek apakah status saat ini adalah 'diproses'
            if ($pengajuan->status !== 'diproses') {
                return redirect()->back()
                    ->with('error', 'Hanya pengajuan yang berstatus "diproses" yang bisa diselesaikan.');
            }

            $pengajuan->status = 'selesai';
            $pengajuan->save();

            return redirect()->route('admin.penelitian.index')
                ->with('success', 'Status pengajuan penelitian telah diperbarui menjadi selesai.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
    
    public function statusUser()
    {
        $pengajuan = Pengajuan::where('user_id', auth()->id())->get();

        return view('user.Pengajuan.index', compact('pengajuan'));
    }

}

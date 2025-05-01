<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengajuan magang dan penelitian
        $pengajuans = Pengajuan::with('user')->get(); // Mengambil data pengajuan beserta relasi user

        return view('admin.pengajuan.index', compact('pengajuans'));
    }
}

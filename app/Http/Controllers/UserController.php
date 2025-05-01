<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function register()
    {
        return view('pages.register');
    }

    /**
     * Memproses registrasi pengguna baru.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRegister(Request $request)
    {
        // Validasi data input dari formulir registrasi
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        // Login otomatis setelah registrasi berhasil
        Auth::login($user);

        // Redirect ke halaman dashboard user
        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Anda telah masuk.');
    }

    /**
     * Menampilkan daftar pengguna.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('pages.user', [
            'data' => User::where('name', 'like', '%' . $request->search . '%')->paginate(10),
            'search' => $request->search,
        ]);
    }

    /**
     * Menambahkan user baru (untuk admin).
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menghapus pengguna.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    /**
     * Memperbarui pengguna.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->back()->with('success', 'User berhasil diperbarui.');
    }
}

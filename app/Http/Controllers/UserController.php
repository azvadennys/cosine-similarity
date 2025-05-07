<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index(Request $request)
    {
        // Ambil query pencarian dari input (dengan default null jika tidak ada input)
        $search = $request->input('search');

        // Query pengguna dengan kondisi pencarian (pencarian berdasarkan nama atau email)
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->paginate(10);  // Menambahkan paginasi dengan 10 item per halaman

        // Kembalikan ke view dengan data pengguna dan query pencarian
        return view('users.index', compact('users', 'search'));
    }

    // Menampilkan form untuk membuat pengguna baru (untuk admin)
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Menyimpan pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil dibuat.');
    }

    // Menampilkan detail pengguna
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, User $user, $id)
    {
        $userDetail = User::where('id', $id)->first();
        // Jika email yang diinput sama dengan email lama, abaikan validasi unique
        $emailRule = 'required|string|email|max:255';
        if ($request->email !== $userDetail->email) {
            $emailRule .= '|unique:users,email';
        }
        // dd($request);

        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'password' => 'nullable|string|', // Validasi password, minimal 8 karakter
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Perbarui data pengguna
        $userDetail->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $userDetail->password,
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil diperbarui.');
    }


    // Menghapus pengguna
    public function destroy(User $user, $id)
    {

        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}

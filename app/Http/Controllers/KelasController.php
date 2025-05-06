<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        // Handling search functionality
        $search = $request->get('search');

        // Get the logged-in user
        $user = auth()->user();

        // Default query to include search functionality
        $query = Kelas::with('dosen');

        // Determine the user's role and adjust the query
        if ($user->role == 'mahasiswa') {
            // If the user is a mahasiswa, filter based on the classes they have joined
            $query->whereHas('mahasiswas', function ($query) use ($user) {
                $query->where('mahasiswa_id', $user->id);
            });
        } elseif ($user->role == 'dosen') {
            // If the user is a dosen, filter based on the classes they are teaching
            $query->where('dosen_id', $user->id);
        }

        // Apply search functionality
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('nama_kelas', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Paginate the results
        $kelas = $query->paginate(10);

        // Fetch dosen for admin or dosen role
        $dosen = User::where('role', 'dosen')->get();

        return view('kelas.index', compact('kelas', 'dosen', 'search'));
    }


    public function create()
    {
        if (Auth::user()->role != 'admin' && Auth::user()->role != 'dosen') {
            return redirect()->route('kelas.index');
        }

        $dosen = User::where('role', 'dosen')->get();
        return view('kelas.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'dosen_id' => 'required|exists:users,id',
        ]);

        // Generate kode unik
        do {
            $kode = Str::upper(Str::random(4)); // Contoh: 8 karakter acak huruf besar
        } while (Kelas::where('kode_bergabung', $kode)->exists());

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi,
            'kode_bergabung' => $kode,
            'dosen_id' => $request->dosen_id,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Berhasil Membuat kelas ' . $request->nama_kelas);
    }

    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        $this->authorize('update', $kelas);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kode_bergabung' => 'required|unique:kelas,kode_bergabung,' . $kelas->id,
        ]);

        $kelas->update($request->all());
        return redirect()->route('kelas.index');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index');
    }

    public function joinClass(Kelas $kelas, Request $request)
    {
        // Validate the join code
        $request->validate([
            'kode_bergabung' => 'required|exists:kelas,kode_bergabung',
        ]);

        // Find the class by the join code
        $kelas = Kelas::where('kode_bergabung', $request->kode_bergabung)->first();

        // Check if the class exists or if the join code is invalid
        if (!$kelas) {
            return redirect()->route('kelas.index')->with('error', 'Invalid join code.');
        }

        // Check if the authenticated user has already joined this class
        if ($kelas->mahasiswas()->where('mahasiswa_id', Auth::id())->exists()) {
            return redirect()->route('kelas.index')->with('error', 'You have already joined this class: ' . $kelas->nama_kelas);
        }

        // Attach the authenticated user to the class
        $kelas->mahasiswas()->attach(Auth::id());

        // Return success message
        return redirect()->route('kelas.index')->with('success', 'You have successfully joined the class ' . $kelas->nama_kelas);
    }


    public function leaveClass(Kelas $kelas)
    {
        $kelas->mahasiswas()->detach(Auth::id()); // Assuming there’s a many-to-many relationship
        return redirect()->route('kelas.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        // Validasi input
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'no_telp' => 'required',
            'role' => 'required',
            'id_kls' => 'required',
        ]);

        // Gunakan transaksi agar jika salah satu gagal, semuanya dibatalkan
        DB::transaction(function () use ($request) {
            // Simpan data user ke tabel users
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_telp' => $request->no_telp,
                'role' => $request->role,
                'alamat' => $request->alamat,
            ]);

            // Simpan data siswa ke tabel siswas
            Siswa::create([
                'id_user' => $user->id,
                'nisn' => $request->nisn,
                'id_kelas' => $request->id_kls,
            ]);
        });

        return back()->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = User::findOrFail($id);

        return view('page.showSiswa', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('page.updateData', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    // use Illuminate\Support\Facades\Auth;

    public function update(UpdateSiswaRequest $request, $id)
    {
        // Cari data siswa dan user terkait
        $siswa = Siswa::findOrFail($id);
        $user = User::findOrFail($siswa->id_user);

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20|unique:siswas,nisn,' . $id,
            'no_telp' => 'required|string|max:15',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email',
            'role' => 'nullable|string',
            'id_kelas' => 'nullable|integer',
        ]);

        // Cek role yang update data
        if (Auth::user()->role == 'siswa') {
            $validatedData['role'] = null;
            $validatedData['nisn'] = null;
            $validatedData['id_kelas'] = null;
        } elseif (Auth::user()->role == 'petugas') {
            $validatedData['role'] = null;
            $validatedData['email'] = null;
            $validatedData['id_kelas'] = null;
        }

        // Gunakan transaksi agar jika salah satu gagal, semuanya dibatalkan
        DB::transaction(function () use ($validatedData, $user, $siswa) {
            // Update data user di tabel users
            $user->update([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'no_telp' => $validatedData['no_telp'],
                'alamat' => $validatedData['alamat'],
                'role' => $validatedData['role'],
            ]);

            // Update data siswa di tabel siswas
            $siswa->update([
                'nisn' => $validatedData['nisn'],
                'id_kelas' => $validatedData['id_kelas'],
            ]);
        });

        return redirect()->route('dashboard.petugas')->with('success', 'Data berhasil diupdate!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
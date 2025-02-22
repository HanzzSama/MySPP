<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil ID terakhir dari session (dikirim dari store)
        // $lastId = session('last_id');

        // Ambil hanya data yang baru saja disimpan
        $data = Pembayaran::orderByDesc('id_pembayaran')->first();

        return view('page.checkTuition', compact('data'));
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
    public function store(StorePembayaranRequest $request)
    {
        // Validasi input
        $request->validate([
            'id_petugas' => 'required|max:15',
            'tgl_bayar' => 'required',
            'nisn' => 'nullable|string|max:20',
            'bulan_bayar' => 'required|string',
            'tahun_bayar' => 'required|string',
            'jumlah_bayar' => 'required|string',
        ]);

        // Simpan data siswa ke database
        Pembayaran::create([
            'id_user' => $request->id_petugas,
            'tgl_bayar' => $request->tgl_bayar,
            'nisn' => $request->nisn ?? null,
            'nis' => $request->nisn,
            'bulan_bayar' => $request->bulan_bayar,
            'tahun_bayar' => $request->tahun_bayar,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect('dashboard/check')->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = User::findOrFail($id);

        return view('page.pembayaran', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
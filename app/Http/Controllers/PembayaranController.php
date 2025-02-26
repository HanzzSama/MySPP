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
            'status' => 'nullable|string|max:20',
            'bulan_bayar' => 'required|string',
            'tahun_bayar' => 'required|string',
            'jumlah_bayar' => 'required|string',
            'uang_sisa' => 'nullable|min:0',
        ]);

        // Simpan data siswa ke database
        Pembayaran::create([
            'id_user' => $request->id_petugas,
            'tgl_bayar' => $request->tgl_bayar,
            'nisn' => $request->nisn ?? null,
            'nis' => $request->nisn,
            'status' => $request->status,
            'bulan_bayar' => $request->bulan_bayar,
            'tahun_bayar' => $request->tahun_bayar,
            'jumlah_bayar' => $request->jumlah_bayar,
            'uang_sisa' => $request->uang_sisa,
        ]);

        return redirect('dashboard/check')->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // Fungsi untuk mengubah nama bulan menjadi angka
    public function convertBulanKeAngka($bulan)
    {
        $daftarBulan = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        return $daftarBulan[$bulan] ?? null;
    }

    // Fungsi untuk mengubah angka bulan menjadi nama bulan
    public function convertAngkaKeBulan($angka)
    {
        $daftarBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $daftarBulan[$angka] ?? null;
    }



    public function show($id)
    {
        // Ambil data user berdasarkan ID
        $data = User::findOrFail($id);

        // Semua bulan dalam setahun
        $semuaBulan = range(1, 12);

        // Ambil data pembayaran yang sudah lunas berdasarkan ID user
        $dataPembayaran = Pembayaran::where('id_user', $id)
            ->where('status', 'Lunas')
            ->orderBy('tahun_bayar', 'desc')
            ->orderBy('bulan_bayar', 'desc')
            ->get(['bulan_bayar', 'tahun_bayar']);

        // Ambil tahun terakhir yang sudah dibayar
        $tahunMulai = date('Y'); // Default tahun sekarang
        $bulanSudahDibayar = [];

        foreach ($dataPembayaran as $bayar) {
            if (strpos($bayar->bulan_bayar, '-') !== false) {
                // Jika terdapat rentang (contoh: Januari-Maret)
                $rentang = explode('-', $bayar->bulan_bayar);
                $bulanMulai = $this->convertBulanKeAngka(trim($rentang[0]));
                $bulanAkhir = $this->convertBulanKeAngka(trim($rentang[1]));

                for ($i = $bulanMulai; $i <= $bulanAkhir; $i++) {
                    $bulanSudahDibayar[] = $i;
                }
            } else {
                $bulanSudahDibayar[] = $this->convertBulanKeAngka(trim($bayar->bulan_bayar));
            }

            // Gunakan tahun terakhir dari pembayaran
            $tahunMulai = $bayar->tahun_bayar;
        }

        // Hitung bulan yang belum dibayar
        $bulanBelumDibayar = array_diff($semuaBulan, $bulanSudahDibayar);

        // Jika belum ada pembayaran, tampilkan semua bulan dalam setahun
        if (empty($dataPembayaran)) {
            $bulanBelumDibayar = $semuaBulan;
        }

        // Ubah angka bulan jadi nama bulan
        $bulanBelumDibayarNama = array_map([$this, 'convertAngkaKeBulan'], $bulanBelumDibayar);

        // Kirim data ke view
        return view('page.pembayaran', compact('data', 'bulanBelumDibayarNama', 'tahunMulai'));
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
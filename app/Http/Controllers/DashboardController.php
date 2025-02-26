<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminHome()
    {
        // $nextUserId = User::max('id') + 1;
        $users = User::with('siswa')->get(); // Ambil user dengan siswa yang terhubung

        // $this->authorize('admin');
        $siswa = Siswa::with('kelas')->latest()->paginate(7);
        $jurusan = Kelas::distinct()->pluck('jurusan'); // Ambil semua jurusan unik

        $jurusan_singkatan = [
            "rekayasa perangkat lunak" => "RPL",
            "teknik elektronik industri" => "TEI",
            "teknik komputer jaringan" => "TKJ",
            "teknik kendaraan ringan" => "TKR",
            "tata busana" => "TB",
            "teknik permesinan" => "TP",
            "teknik pemintalan serat buatan" => "TPSB",
        ];

        // Tambahkan singkatan jurusan ke setiap siswa
        foreach ($siswa as $item) {
            $jurusan_full = strtolower(trim($item->kelas->jurusan ?? ''));
            $item->kelas->singkatan_jurusan = $jurusan_singkatan[$jurusan_full] ?? $jurusan_full;
        }

        // Ambil semua data pembayaran dengan relasi ke user
        $pembayaran = Pembayaran::with('user')->latest()->get();

        // Hitung jumlah user dengan role "petugas"
        $jumlah_petugas = User::where('role', 'petugas')->count();

        return view('dashboard.AdminDashboard', compact('siswa', 'jurusan', 'users', 'pembayaran', 'jumlah_petugas'), [
            'siswa' => Siswa::all(),
            'total_spp' => Pembayaran::sum('jumlah_bayar') // Total semua uang SPP
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function petugasHome()
    {
        // $nextUserId = User::max('id') + 1;
        $users = User::with('siswa')->get(); // Ambil user dengan siswa yang terhubung

        // $this->authorize('admin');
        $siswa = Siswa::with('kelas')->latest()->paginate(7);
        $jurusan = Kelas::distinct()->pluck('jurusan'); // Ambil semua jurusan unik

        $jurusan_singkatan = [
            "rekayasa perangkat lunak" => "RPL",
            "teknik elektronik industri" => "TEI",
            "teknik komputer jaringan" => "TKJ",
            "teknik kendaraan ringan" => "TKR",
            "tata busana" => "TB",
            "teknik permesinan" => "TP",
            "teknik pemintalan serat buatan" => "TPSB",
        ];

        // Tambahkan singkatan jurusan ke setiap siswa
        foreach ($siswa as $item) {
            $jurusan_full = strtolower(trim($item->kelas->jurusan ?? ''));
            $item->kelas->singkatan_jurusan = $jurusan_singkatan[$jurusan_full] ?? $jurusan_full;
        }

        // Ambil semua data pembayaran dengan relasi ke user
        $pembayaran = Pembayaran::with('user')->latest()->get();

        return view('dashboard.PetugasDashboard', compact('siswa', 'jurusan', 'users', 'pembayaran'), [
            'siswa' => Siswa::all(),
            'total_spp' => Pembayaran::sum('jumlah_bayar') // Total semua uang SPP
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function siswaHome()
    {
        $pembayarans = Auth::user()->pembayarans()->orderBy('tgl_bayar', 'desc')->get();
        $siswa = Siswa::with('kelas')->latest()->paginate(7);
        $jurusan = Kelas::distinct()->pluck('jurusan'); // Ambil semua jurusan unik

        $jurusan_singkatan = [
            "rekayasa perangkat lunak" => "RPL",
            "teknik elektronik industri" => "TEI",
            "teknik komputer jaringan" => "TKJ",
            "teknik kendaraan ringan" => "TKR",
            "tata busana" => "TB",
            "teknik permesinan" => "TP",
            "teknik pemintalan serat buatan" => "TPSB",
        ];

        // Tambahkan singkatan jurusan ke setiap siswa
        foreach ($siswa as $item) {
            $jurusan_full = strtolower(trim($item->kelas->jurusan ?? ''));
            $item->kelas->singkatan_jurusan = $jurusan_singkatan[$jurusan_full] ?? $jurusan_full;
        }

        return view('dashboard.siswaDashboard', compact('siswa', 'jurusan', 'pembayarans'), [
            'siswa' => Siswa::all(),
            'total_spp' => Pembayaran::sum('jumlah_bayar') // Total semua uang SPP
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function showTuition($id)
    {
        // Ambil ID terakhir dari session (dikirim dari store)
        // $lastId = session('last_id');

        // Ambil hanya data yang baru saja disimpan
        $data = Pembayaran::findOrFail($id);

        return view('page.checkTuition', compact('data'));
    }
}
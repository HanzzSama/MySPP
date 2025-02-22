<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminHome()
    {
        return view('dashboard.AdminDashboard');
    }

    public function petugasHome()
    {
        // $nextUserId = User::max('id') + 1;
        $users = User::with('siswa')->get(); // Ambil user dengan siswa yang terhubung

        return view('dashboard.PetugasDashboard', compact('users'));
    }

    public function siswaHome()
    {
        return view('dashboard.Siswadashboard');
    }
}
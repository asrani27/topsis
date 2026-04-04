<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Get counts from database
        $totalPegawai = Pegawai::count();
        $totalKriteria = Kriteria::count();
        $totalPenilaian = Penilaian::count();
        $totalUsers = User::count();

        // Get admin and regular user counts
        $totalAdmin = User::count();
        $totalRegularUsers = User::count();

        // Calculate completed assessments percentage
        $penilaianPercentage = $totalPegawai > 0 ? round(($totalPenilaian / $totalPegawai) * 100) : 0;

        return view('admin.dashboard', compact(
            'totalPegawai',
            'totalKriteria',
            'totalPenilaian',
            'totalUsers',
            'totalAdmin',
            'totalRegularUsers',
            'penilaianPercentage'
        ));
    }
}

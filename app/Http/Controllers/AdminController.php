<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Penyewaan;
use App\Models\BagiHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Total motor
        $totalMotors = Motor::count();

        // Total motor yang sedang disewa (status 'disewa')
        $totalDisewa = Motor::where('status', 'disewa')->count();

        // Total pendapatan pemilik
        $totalPemilik = BagiHasil::sum('bagi_hasil_pemilik');

        // Total pendapatan admin
        $totalAdmin = BagiHasil::sum('bagi_hasil_admin');

        // Grafik penyewaan per bulan
        $grafik = Penyewaan::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as jumlah')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        return view('admin.dashboard', compact(
            'totalMotors',
            'totalDisewa',
            'totalPemilik',
            'totalAdmin',
            'grafik'
        ));
    }
}

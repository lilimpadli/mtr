<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Penyewaan;
use App\Models\BagiHasil;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminReportExport;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminReportController extends Controller
{
    // Laporan pendapatan & grafik
    public function index(Request $request)
    {
        $totalMotors = Motor::count();
        $totalDisewa = Motor::where('status','disewa')->count();

        $totalPendapatan = BagiHasil::sum(DB::raw('bagi_hasil_pemilik + bagi_hasil_admin'));
        $totalPemilik = BagiHasil::sum('bagi_hasil_pemilik');
        $totalAdmin   = BagiHasil::sum('bagi_hasil_admin');

        // Data untuk grafik (jumlah booking per bulan)
        $grafik = Penyewaan::select(
            DB::raw('MONTH(tanggal_mulai) as bulan'),
            DB::raw('COUNT(*) as jumlah')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        return view('admin.reports.index', compact(
            'totalMotors','totalDisewa',
            'totalPendapatan','totalPemilik','totalAdmin','grafik'
        ));
    }

    public function exportExcel()
{
    return Excel::download(new AdminReportExport, 'laporan_admin.xlsx');
}

public function exportPdf()
{
    $laporan = BagiHasil::with('penyewaan.motor')->get();
    $pdf = Pdf::loadView('admin.reports.pdf', compact('laporan'));
    return $pdf->download('laporan_admin.pdf');
}
}

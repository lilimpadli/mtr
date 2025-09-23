<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\BagiHasil;
use Illuminate\Support\Facades\Auth;
use DB;

class OwnerReportController extends Controller
{
    public function index()
    {
        $motors = Motor::where('pemilik_id', Auth::id())->with('penyewaans')->get();

        $totalPendapatan = BagiHasil::whereHas('penyewaan.motor', function($q){
            $q->where('pemilik_id', Auth::id());
        })->sum('bagi_hasil_pemilik');

        return view('owner.reports.index', compact('motors','totalPendapatan'));
    }
}

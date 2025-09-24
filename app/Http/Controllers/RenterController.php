<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class RenterController extends Controller
{
    public function dashboard()
    {
        // ambil semua motor + tarifnya
        $motors = Motor::with('tarif')->get();

        // kirim ke view
        return view('renter.dashboard', compact('motors'));
    }
}

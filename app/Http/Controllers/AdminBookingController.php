<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Motor;
use App\Models\Transaksi;
use App\Models\BagiHasil;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    // Daftar semua booking
    public function index()
    {
        $bookings = Penyewaan::with('motor.pemilik','penyewa','transaksi')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // Konfirmasi pembayaran & set motor jadi disewa
    public function confirm($id)
    {
        $booking = Penyewaan::with('motor','transaksi')->findOrFail($id);

        if ($booking->transaksi) {
            $booking->transaksi->update(['status' => 'berhasil']);
        }

        $booking->update(['status' => 'disewa']);
        $booking->motor->update(['status' => 'disewa']);

        return back()->with('success', 'Booking dikonfirmasi, motor disewa!');
    }

    // Konfirmasi pengembalian → motor tersedia lagi, buat bagi hasil
    public function finish($id)
    {
        $booking = Penyewaan::with('motor','transaksi')->findOrFail($id);

        $booking->update(['status' => 'selesai']);
        $booking->motor->update(['status' => 'tersedia']);

        // hitung bagi hasil (contoh: pemilik 70%, admin 30%)
        $pemilik_share = $booking->harga * 0.7;
        $admin_share   = $booking->harga * 0.3;

        BagiHasil::create([
            'penyewaan_id' => $booking->id,
            'bagi_hasil_pemilik' => $pemilik_share,
            'bagi_hasil_admin' => $admin_share,
            'tanggal' => Carbon::today(),
            'settled_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Pengembalian dikonfirmasi, bagi hasil tercatat!');
    }
}

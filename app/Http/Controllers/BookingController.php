<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Penyewaan;
use App\Models\TarifRental;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Daftar motor yang tersedia
    public function index()
    {
        $motors = Motor::where('status', 'tersedia')->with('tarif')->get();
        return view('renter.motors.index', compact('motors'));
    }

    // Form booking
    public function create($motorId)
    {
        $motor = Motor::with('tarif')->findOrFail($motorId);
        return view('renter.bookings.create', compact('motor'));
    }

    // Simpan booking
    public function store(Request $request, $motorId)
    {
        $motor = Motor::with('tarif')->findOrFail($motorId);

        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'tipe_durasi' => 'required|in:harian,mingguan,bulanan',
        ]);

        // hitung harga berdasarkan tarif
        $days = (strtotime($request->tanggal_selesai) - strtotime($request->tanggal_mulai)) / 86400 + 1;
        $harga = match ($request->tipe_durasi) {
            'harian' => $motor->tarif->tarif_harian * $days,
            'mingguan' => $motor->tarif->tarif_mingguan * ceil($days / 7),
            'bulanan' => $motor->tarif->tarif_bulanan * ceil($days / 30),
        };

        $penyewaan = Penyewaan::create([
            'penyewa_id' => Auth::id(),
            'motor_id' => $motor->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tipe_durasi' => $request->tipe_durasi,
            'harga' => $harga,
            'status' => 'pending',
        ]);

        return redirect()->route('renter.bookings.pay', $penyewaan->id);
    }

    // Form pembayaran
    public function pay($id)
    {
        $booking = Penyewaan::with('motor')->findOrFail($id);
        return view('renter.bookings.pay', compact('booking'));
    }

    // Simpan pembayaran
    public function processPayment(Request $request, $id)
    {
        $booking = Penyewaan::findOrFail($id);

        $request->validate([
            'metode_pembayaran' => 'required|in:cash,transfer,ewallet',
        ]);

        Transaksi::create([
            'penyewaan_id' => $booking->id,
            'jumlah' => $booking->harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'pending', // admin nanti konfirmasi
        ]);

        return redirect()->route('renter.bookings.history')->with('success','Pembayaran berhasil dikirim, menunggu konfirmasi admin');
    }

    // Histori penyewaan
    public function history()
    {
        $bookings = Penyewaan::where('penyewa_id', Auth::id())->with('motor','transaksi')->get();
        return view('renter.bookings.history', compact('bookings'));
    }
}

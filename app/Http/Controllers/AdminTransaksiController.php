<?php

namespace App\Http\Controllers;


use App\Models\Penyewaan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    // Tampilkan semua pembayaran
    public function index()
    {
        $pembayaran = Transaksi::with('penyewaan.motor','penyewaan.penyewa')->get();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    // Form tambah pembayaran
    public function create($penyewaan_id)
    {
        $penyewaan = Penyewaan::findOrFail($penyewaan_id);
        return view('admin.pembayaran.create', compact('penyewaan'));
    }

    // Simpan pembayaran baru
    public function store(Request $request, $penyewaan_id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'status' => 'required|in:pending,lunas'
        ]);

        $penyewaan = Penyewaan::findOrFail($penyewaan_id);

        Transaksi::create([
            'penyewaan_id' => $penyewaan->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'tanggal' => now(),
        ]);

        if ($request->status === 'lunas') {
            $penyewaan->update(['status' => 'selesai']);
        }

        return redirect()->route('admin.pembayaran.index')->with('success','Pembayaran berhasil dicatat!');
    }

    // Edit pembayaran
    public function edit($id)
    {
        $pembayaran = Transaksi::findOrFail($id);
        return view('admin.pembayaran.edit', compact('pembayaran'));
    }

    // Update pembayaran
    public function update(Request $request, $id)
    {
        $pembayaran = Transaksi::findOrFail($id);

        $request->validate([
            'metode' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'status' => 'required|in:pending,lunas'
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('admin.pembayaran.index')->with('success','Pembayaran berhasil diperbarui!');
    }

    // Hapus pembayaran
    public function destroy($id)
    {
        $pembayaran = Transaksi::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')->with('success','Pembayaran berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TarifRental;
use App\Models\Motor;
use Illuminate\Http\Request;

class AdminTarifController extends Controller
{
    // READ: daftar tarif
    public function index()
    {
        $tarifs = TarifRental::with('motor')->get();
        return view('admin.tarifs.index', compact('tarifs'));
    }

    // CREATE: form tambah
    public function create()
    {
        $motors = Motor::all();
        return view('admin.tarifs.create', compact('motors'));
    }

    // STORE: simpan tarif baru
    public function store(Request $request)
    {
        $request->validate([
            'motor_id' => 'required|exists:motors,id',
            'tarif_harian' => 'nullable|numeric',
            'tarif_mingguan' => 'nullable|numeric',
            'tarif_bulanan' => 'nullable|numeric',
        ]);

        TarifRental::create($request->all());

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif berhasil ditambahkan!');
    }

    // EDIT: form edit tarif
    public function edit($id)
    {
        $tarif = TarifRental::findOrFail($id);
        $motors = Motor::all();
        return view('admin.tarifs.edit', compact('tarif', 'motors'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, $id)
    {
        $tarif = TarifRental::findOrFail($id);

        $request->validate([
            'motor_id' => 'required|exists:motors,id',
            'tarif_harian' => 'nullable|numeric',
            'tarif_mingguan' => 'nullable|numeric',
            'tarif_bulanan' => 'nullable|numeric',
        ]);

        $tarif->update($request->all());

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif berhasil diperbarui!');
    }

    // DELETE: hapus tarif
    public function destroy($id)
    {
        $tarif = TarifRental::findOrFail($id);
        $tarif->delete();

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\TarifRental;
use Illuminate\Http\Request;

class AdminMotorController extends Controller
{
    // Daftar motor menunggu verifikasi
    public function index()
    {
        $motors = Motor::with('pemilik','tarif')->get();
        return view('admin.motors.index', compact('motors'));
    }

    // Form edit/verify motor
    public function edit($id)
    {
        $motor = Motor::with('tarif')->findOrFail($id);
        return view('admin.motors.edit', compact('motor'));
    }

    // Update status & tarif
    public function update(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);

        $request->validate([
            'status' => 'required|in:tersedia,disewa,perawatan',
            'tarif_harian' => 'nullable|numeric',
            'tarif_mingguan' => 'nullable|numeric',
            'tarif_bulanan' => 'nullable|numeric',
        ]);

        // update status
        $motor->update(['status' => $request->status]);

        // update atau buat tarif
        TarifRental::updateOrCreate(
            ['motor_id' => $motor->id],
            [
                'tarif_harian' => $request->tarif_harian,
                'tarif_mingguan' => $request->tarif_mingguan,
                'tarif_bulanan' => $request->tarif_bulanan,
            ]
        );

        return redirect()->route('admin.motors.index')->with('success','Motor berhasil diverifikasi & tarif diupdate');
    }
public function approve($id)
{
    $motor = Motor::findOrFail($id);
    $motor->update(['status' => 'tersedia']);

    return redirect()->route('admin.motors.index')->with('success', 'Motor berhasil diterima.');
}

public function reject($id)
{
    $motor = Motor::findOrFail($id);
    $motor->update(['status' => 'ditolak']);

    return redirect()->route('admin.motors.index')->with('error', 'Motor ditolak.');
}

    
}

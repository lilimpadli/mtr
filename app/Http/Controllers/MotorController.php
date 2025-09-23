<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MotorController extends Controller
{
    // List motor milik user (pemilik)
    public function index()
    {
        $motors = Motor::where('pemilik_id', Auth::id())->get();
        return view('owner.motors.index', compact('motors'));
    }

    // Form tambah motor
    public function create()
    {
        return view('owner.motors.create');
    }

    // Simpan motor
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'tipe_cc' => 'required|in:100,125,150',
            'no_plat' => 'required|unique:motors',
            'photo' => 'nullable|image',
            'dokumen_kepemilikan' => 'nullable|file',
        ]);

        $photoPath = $request->file('photo')?->store('photos', 'public');
        $docPath   = $request->file('dokumen_kepemilikan')?->store('docs', 'public');

        Motor::create([
            'pemilik_id' => Auth::id(),
            'merk' => $request->merk,
            'tipe_cc' => $request->tipe_cc,
            'no_plat' => $request->no_plat,
            'photo' => $photoPath,
            'dokumen_kepemilikan' => $docPath,
        ]);

        return redirect()->route('owner.motors.index')->with('success', 'Motor berhasil ditambahkan!');
    }

    // Hapus motor
    public function destroy(Motor $motor)
    {
        if ($motor->pemilik_id !== Auth::id()) {
            abort(403);
        }
        $motor->delete();
        return back()->with('success', 'Motor berhasil dihapus!');
    }
}

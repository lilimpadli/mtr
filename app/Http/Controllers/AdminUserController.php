<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_tlpn' => 'required',
            'role' => 'required|in:admin,pemilik,penyewa',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_tlpn' => $request->no_tlpn,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success','User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'no_tlpn' => 'required',
            'role' => 'required|in:admin,pemilik,penyewa',
        ]);

        $data = $request->only(['nama','email','no_tlpn','role']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success','User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','User berhasil dihapus!');
    }
    public function exportExcel()
{
    return Excel::download(new UsersExport, 'users.xlsx');
}

public function exportPdf()
{
    $users = User::all();
    $pdf = Pdf::loadView('admin.users.pdf', compact('users'));
    return $pdf->download('users.pdf');
}
}

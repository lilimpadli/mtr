@extends('layouts.app')

@section('content')
  <h2>Dashboard Penyewa</h2>
  <p>Halo, {{ Auth::user()->nama }}! Cari motor, booking, dan cek riwayat sewa di sini.</p>
@endsection

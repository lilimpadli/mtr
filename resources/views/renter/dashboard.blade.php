@extends('layouts.app')

@section('content')
  <h2 class="mb-4">Dashboard Penyewa</h2>
  <p class="lead">Halo, {{ Auth::user()->nama }}! Cari motor, booking, dan cek riwayat sewa di sini.</p>

  <hr>

  <h2 class="mt-4 mb-3">Daftar Motor Tersedia</h2>

  <div class="row">
      @forelse($motors as $motor)
      <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
              <img src="{{ $motor->photo ? asset('storage/'.$motor->photo) : asset('images/default-motor.png') }}" 
                   class="card-img-top" 
                   alt="{{ $motor->merk }}" 
                   style="height:200px; object-fit:cover;">

              <div class="card-body">
                  <h5 class="card-title">{{ $motor->merk }} ({{ $motor->tipe_cc }} cc)</h5>
                  <p class="card-text">
                      <strong>No Plat:</strong> {{ $motor->no_plat }} <br>
                      @if($motor->tarif)
                          <strong>Tarif:</strong> <br>
                          H: Rp{{ number_format($motor->tarif->tarif_harian,0,',','.') }} <br>
                          M: Rp{{ number_format($motor->tarif->tarif_mingguan,0,',','.') }} <br>
                          B: Rp{{ number_format($motor->tarif->tarif_bulanan,0,',','.') }}
                      @else
                          <span class="text-muted">Tarif belum diatur</span>
                      @endif
                  </p>
              </div>
              <div class="card-footer text-center">
                  <a href="{{ route('renter.bookings.create',$motor->id) }}" class="btn btn-success w-100">Booking</a>
              </div>
          </div>
      </div>
      @empty
          <div class="col-12">
              <div class="alert alert-info text-center">
                  Belum ada motor tersedia.
              </div>
          </div>
      @endforelse
  </div>
@endsection

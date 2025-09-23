@extends('layouts.app')

@section('content')
<h2>Booking Motor: {{ $motor->merk }} ({{ $motor->tipe_cc }} cc)</h2>
<form action="{{ route('renter.bookings.store',$motor->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tipe Durasi</label>
        <select name="tipe_durasi" class="form-control" required>
            <option value="harian">Harian</option>
            <option value="mingguan">Mingguan</option>
            <option value="bulanan">Bulanan</option>
        </select>
    </div>
    <button class="btn btn-primary">Pesan</button>
</form>
@endsection

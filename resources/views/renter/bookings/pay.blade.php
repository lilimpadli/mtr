@extends('layouts.app')

@section('content')
<h2>Pembayaran Booking</h2>
<p>Motor: {{ $booking->motor->merk }} ({{ $booking->motor->tipe_cc }} cc)</p>
<p>Harga: Rp{{ $booking->harga }}</p>
<form action="{{ route('renter.bookings.processPayment',$booking->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Metode Pembayaran</label>
        <select name="metode_pembayaran" class="form-control" required>
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="ewallet">E-Wallet</option>
        </select>
    </div>
    <button class="btn btn-success">Bayar</button>
</form>
@endsection

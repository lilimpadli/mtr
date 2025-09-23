@extends('layouts.app')

@section('content')
<h2>Tambah Pembayaran untuk Penyewaan #{{ $penyewaan->id }}</h2>

<form action="{{ route('admin.pembayaran.store', $penyewaan->id) }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Metode Pembayaran</label>
    <select name="metode" class="form-control" required>
      <option value="transfer">Transfer Bank</option>
      <option value="cash">Cash</option>
      <option value="ewallet">E-Wallet</option>
    </select>
  </div>
  <div class="mb-3">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
      <option value="pending">Pending</option>
      <option value="lunas">Lunas</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection

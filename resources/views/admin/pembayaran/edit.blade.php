@extends('layouts.app')

@section('content')
<h2>Edit Pembayaran</h2>

<form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Metode Pembayaran</label>
    <input type="text" name="metode" class="form-control" value="{{ $pembayaran->metode }}" required>
  </div>
  <div class="mb-3">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" value="{{ $pembayaran->jumlah }}" required>
  </div>
  <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
      <option value="pending" {{ $pembayaran->status=='pending'?'selected':'' }}>Pending</option>
      <option value="lunas" {{ $pembayaran->status=='lunas'?'selected':'' }}>Lunas</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection

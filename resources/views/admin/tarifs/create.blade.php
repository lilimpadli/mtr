@extends('layouts.app')

@section('content')
<h2>Tambah Tarif Rental</h2>
<form action="{{ route('admin.tarifs.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Motor</label>
    <select name="motor_id" class="form-control" required>
      <option value="">Pilih Motor</option>
      @foreach($motors as $m)
      <option value="{{ $m->id }}">{{ $m->merk }} - {{ $m->cc }}cc</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Tarif Harian</label>
    <input type="number" name="tarif_harian" class="form-control">
  </div>
  <div class="mb-3">
    <label>Tarif Mingguan</label>
    <input type="number" name="tarif_mingguan" class="form-control">
  </div>
  <div class="mb-3">
    <label>Tarif Bulanan</label>
    <input type="number" name="tarif_bulanan" class="form-control">
  </div>
  <button class="btn btn-success">Simpan</button>
</form>
@endsection

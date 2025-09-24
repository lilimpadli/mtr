@extends('layouts.app')

@section('content')
<h2>Edit Tarif Rental</h2>
<form action="{{ route('admin.tarifs.update', $tarif->id) }}" method="POST">

  @csrf @method('PUT')
  <div class="mb-3">
    <label>Motor</label>
    <select name="motor_id" class="form-control" required>
      @foreach($motors as $m)
      <option value="{{ $m->id }}" {{ $tarif->motor_id==$m->id?'selected':'' }}>
        {{ $m->merk }} - {{ $m->cc }}cc
      </option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Tarif Harian</label>
    <input type="number" name="tarif_harian" class="form-control" value="{{ $tarif->tarif_harian }}">
  </div>
  <div class="mb-3">
    <label>Tarif Mingguan</label>
    <input type="number" name="tarif_mingguan" class="form-control" value="{{ $tarif->tarif_mingguan }}">
  </div>
  <div class="mb-3">
    <label>Tarif Bulanan</label>
    <input type="number" name="tarif_bulanan" class="form-control" value="{{ $tarif->tarif_bulanan }}">
  </div>
  <button class="btn btn-success">Update</button>
</form>
@endsection

@extends('layouts.app')

@section('content')
<h2>Verifikasi Motor</h2>
<form action="{{ route('admin.motors.update',$motor->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="tersedia" {{ $motor->status=='tersedia'?'selected':'' }}>Tersedia</option>
            <option value="disewa" {{ $motor->status=='disewa'?'selected':'' }}>Disewa</option>
            <option value="perawatan" {{ $motor->status=='perawatan'?'selected':'' }}>Perawatan</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Tarif Harian</label>
        <input type="number" name="tarif_harian" class="form-control" value="{{ $motor->tarif->tarif_harian ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Tarif Mingguan</label>
        <input type="number" name="tarif_mingguan" class="form-control" value="{{ $motor->tarif->tarif_mingguan ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Tarif Bulanan</label>
        <input type="number" name="tarif_bulanan" class="form-control" value="{{ $motor->tarif->tarif_bulanan ?? '' }}">
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection

@extends('layouts.app')

@section('content')
<h2>Tambah Motor</h2>
<form action="{{ route('owner.motors.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Merk</label>
        <input type="text" name="merk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tipe CC</label>
        <select name="tipe_cc" class="form-control" required>
            <option value="100">100 cc</option>
            <option value="125">125 cc</option>
            <option value="150">150 cc</option>
        </select>
    </div>
    <div class="mb-3">
        <label>No Plat</label>
        <input type="text" name="no_plat" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Foto</label>
        <input type="file" name="photo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Dokumen Kepemilikan</label>
        <input type="file" name="dokumen_kepemilikan" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection

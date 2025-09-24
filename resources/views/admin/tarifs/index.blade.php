@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Daftar Tarif Rental</h2>
            <p class="text-muted mb-0">Kelola tarif sewa motor</p>
        </div>
        <a href="{{ route('admin.tarifs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Tarif
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">Data Tarif Sewa</h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-primary">{{ $tarifs->count() }} Tarif</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Informasi Motor</th>
                            <th>Tarif Harian</th>
                            <th>Tarif Mingguan</th>
                            <th>Tarif Bulanan</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tarifs as $index => $tarif)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="motor-icon me-3">
                                        <i class="fas fa-motorcycle fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $tarif->motor->merk ?? '-' }}</div>
                                        <small class="text-muted">
                                            {{ $tarif->motor->tipe_cc ?? '-' }} cc | 
                                            {{ $tarif->motor->no_plat ?? '-' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="tarif-item">
                                    <div class="tarif-amount">
                                        Rp{{ number_format($tarif->tarif_harian, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">per hari</small>
                                </div>
                            </td>
                            <td>
                                <div class="tarif-item">
                                    <div class="tarif-amount">
                                        Rp{{ number_format($tarif->tarif_mingguan, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">per minggu</small>
                                </div>
                            </td>
                            <td>
                                <div class="tarif-item">
                                    <div class="tarif-amount">
                                        Rp{{ number_format($tarif->tarif_bulanan, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">per bulan</small>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.tarifs.edit', $tarif->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="Edit Tarif">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.tarifs.destroy', $tarif->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif untuk motor {{ $tarif->motor->merk ?? '' }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Hapus Tarif">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan {{ $tarifs->count() }} tarif</small>
                <div>
                    <!-- Pagination jika diperlukan -->
                    {{-- {{ $tarifs->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.motor-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 123, 255, 0.1);
    border-radius: 8px;
}

.tarif-item {
    padding: 8px;
    background-color: #f8f9fa;
    border-radius: 6px;
    text-align: center;
}

.tarif-amount {
    font-weight: bold;
    font-size: 1.1rem;
    color: #0d6efd;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.btn-group .btn {
    border-radius: 0.25rem;
}

.btn-group .btn:not(:last-child) {
    margin-right: 0.25rem;
}
</style>
@endpush
@endsection
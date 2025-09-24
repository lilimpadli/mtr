@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-motorcycle me-2"></i>Daftar Motor (Verifikasi Admin)</h2>
        <span class="badge bg-primary fs-6">{{ $motors->count() }} Motor</span>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Pemilik</th>
                            <th>Detail Motor</th>
                            <th>No Plat</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Dokumen</th>
                            <th>Tarif Sewa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($motors as $motor)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">
                                        {{ strtoupper(substr($motor->pemilik->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $motor->pemilik->nama }}</div>
                                        <small class="text-muted">{{ $motor->pemilik->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $motor->merk }}</div>
                                <small class="text-muted">{{ $motor->tipe_cc }} cc</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $motor->no_plat }}</span>
                            </td>
                            <td>
                                @if($motor->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($motor->status === 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @elseif($motor->status === 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if($motor->photo)
                                    <img src="{{ asset('storage/'.$motor->photo) }}" 
                                         alt="Foto Motor" 
                                         class="img-thumbnail" 
                                         style="max-width: 80px; cursor: pointer;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#photoModal{{ $motor->id }}">
                                @else
                                    <span class="text-muted"><i class="fas fa-image-slash"></i> Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                @if($motor->dokumen_kepemilikan)
                                    <a href="{{ asset('storage/'.$motor->dokumen_kepemilikan) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-pdf me-1"></i> Lihat Dokumen
                                    </a>
                                @else
                                    <span class="text-muted"><i class="fas fa-file-slash"></i> Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                @if($motor->tarif)
                                    <div class="tarif-box">
                                        <div class="d-flex justify-content-between">
                                            <span>Harian:</span>
                                            <strong>Rp{{ number_format($motor->tarif->tarif_harian, 0, ',', '.') }}</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Mingguan:</span>
                                            <strong>Rp{{ number_format($motor->tarif->tarif_mingguan, 0, ',', '.') }}</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Bulanan:</span>
                                            <strong>Rp{{ number_format($motor->tarif->tarif_bulanan, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted fst-italic">Belum ditetapkan</span>
                                @endif
                            </td>
                            <td>
                                @if($motor->status === 'pending')
                                    <div class="btn-group-vertical w-100" role="group">
                                        <form action="{{ route('admin.motors.approve', $motor->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success mb-1 w-100">
                                                <i class="fas fa-check me-1"></i> Terima
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.motors.reject', $motor->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                                <i class="fas fa-times me-1"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="text-center">
                                        @if($motor->status === 'tersedia')
                                            <i class="fas fa-check-circle text-success"></i> 
                                            <span class="text-success">Diterima</span>
                                        @else
                                            <i class="fas fa-times-circle text-danger"></i> 
                                            <span class="text-danger">Ditolak</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                        
                        <!-- Modal untuk foto -->
                        <div class="modal fade" id="photoModal{{ $motor->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Foto Motor - {{ $motor->merk }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/'.$motor->photo) }}" 
                                             alt="Foto Motor" 
                                             class="img-fluid rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #6c757d;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.tarif-box {
    background-color: #f8f9fa;
    border-radius: 6px;
    padding: 8px;
    font-size: 0.85rem;
}

.tarif-box div {
    margin-bottom: 4px;
}

.tarif-box div:last-child {
    margin-bottom: 0;
}
</style>
@endpush
@endsection
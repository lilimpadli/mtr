@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-dark">Dashboard Admin</h2>
      <p class="text-muted mb-0">Halo, <span class="fw-semibold text-primary">{{ Auth::user()->nama }}</span>! Selamat datang di panel admin.</p>
    </div>
    <div class="text-end">
      <span class="badge bg-light text-dark px-3 py-2">
        <i class="far fa-clock me-1"></i> {{ now()->format('d M Y H:i') }}
      </span>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100 transition-hover">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                <i class="fas fa-motorcycle fa-2x text-primary"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Total Motor</h6>
              <h3 class="fw-bold mb-0">{{ $totalMotors }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100 transition-hover">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-success bg-opacity-10 rounded-3 p-3">
                <i class="fas fa-check-circle fa-2x text-success"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Motor Disewa</h6>
              <h3 class="fw-bold mb-0">{{ $totalDisewa }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100 transition-hover">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-info bg-opacity-10 rounded-3 p-3">
                <i class="fas fa-user-tie fa-2x text-info"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Pendapatan Pemilik</h6>
              <h3 class="fw-bold mb-0">Rp{{ number_format($totalPemilik, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100 transition-hover">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                <i class="fas fa-chart-line fa-2x text-warning"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Pendapatan Admin</h6>
              <h3 class="fw-bold mb-0">Rp{{ number_format($totalAdmin, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Chart Section -->
  <div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold text-dark">Grafik Penyewaan Per Bulan</h4>
        <div class="dropdown">
          <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-ellipsis-h"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Export Data</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-5">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="table-light">
                <tr>
                  <th class="border-0 text-muted">Bulan</th>
                  <th class="border-0 text-muted text-end">Jumlah Penyewaan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($grafik as $g)
                <tr>
                  <td class="fw-medium">{{ $g->bulan }}</td>
                  <td class="text-end">
                    <span class="badge bg-light text-dark fw-normal">{{ $g->jumlah }}</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="p-3 bg-light bg-opacity-50 rounded-3">
            <canvas id="chartPenyewaan" height="120"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .transition-hover {
    transition: all 0.3s ease;
  }
  .transition-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
  .table-hover tbody tr:hover {
    background-color: rgba(0,123,255,0.05);
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chartPenyewaan').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!! json_encode($grafik->pluck('bulan')) !!},
        datasets: [{
          label: 'Jumlah Penyewaan',
          data: {!! json_encode($grafik->pluck('jumlah')) !!},
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          borderRadius: 5,
          maxBarThickness: 40
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.8)',
            padding: 12,
            titleFont: {
              size: 14
            },
            bodyFont: {
              size: 13
            },
            callbacks: {
              label: function(context) {
                return `Penyewaan: ${context.parsed.y} unit`;
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0,0,0,0.05)'
            },
            ticks: {
              font: {
                size: 12
              }
            }
          },
          x: {
            grid: {
              display: false
            },
            ticks: {
              font: {
                size: 12
              }
            }
          }
        }
      }
    });
  });
</script>
@endsection
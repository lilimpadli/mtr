@extends('layouts.app')

@section('content')
<h2>Laporan Admin</h2>
<a href="{{ route('admin.reports.export.excel') }}" class="btn btn-success mb-3">Export Excel</a>
<a href="{{ route('admin.reports.export.pdf') }}" class="btn btn-danger mb-3">Export PDF</a>

<div class="row mb-3">
  <div class="col-md-3">
    <div class="card p-3">
      <h4>Total Motor</h4>
      <p>{{ $totalMotors }}</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3">
      <h4>Motor Disewa</h4>
      <p>{{ $totalDisewa }}</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3">
      <h4>Pendapatan Pemilik</h4>
      <p>Rp{{ number_format($totalPemilik, 0, ',', '.') }}</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3">
      <h4>Pendapatan Admin</h4>
      <p>Rp{{ number_format($totalAdmin, 0, ',', '.') }}</p>
    </div>
  </div>
</div>

<h4>Grafik Penyewaan Per Bulan</h4>
<div class="row">
  <div class="col-md-6">
    <!-- Tabel Penyewaan -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Bulan</th>
          <th>Jumlah Penyewaan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($grafik as $g)
        <tr>
          <td>{{ $g->bulan }}</td>
          <td>{{ $g->jumlah }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
    <!-- Grafik Chart.js -->
    <canvas id="chartPenyewaan" width="400" height="200"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('chartPenyewaan');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($grafik->pluck('bulan')) !!},
      datasets: [{
        label: 'Jumlah Penyewaan',
        data: {!! json_encode($grafik->pluck('jumlah')) !!},
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script>
@endsection

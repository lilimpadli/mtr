<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Pendapatan Admin</title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid black; padding: 6px; text-align: left; }
    th { background: #f2f2f2; }
  </style>
</head>
<body>
  <h3>Laporan Pendapatan Admin</h3>
  <table>
    <thead>
      <tr>
        <th>ID Penyewaan</th>
        <th>Motor</th>
        <th>Tanggal</th>
        <th>Pemilik</th>
        <th>Admin</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($laporan as $row)
      <tr>
        <td>{{ $row->penyewaan_id }}</td>
        <td>{{ $row->penyewaan->motor->merk ?? '-' }}</td>
        <td>{{ $row->tanggal }}</td>
        <td>Rp{{ number_format($row->bagi_hasil_pemilik,0,',','.') }}</td>
        <td>Rp{{ number_format($row->bagi_hasil_admin,0,',','.') }}</td>
        <td>Rp{{ number_format($row->bagi_hasil_pemilik + $row->bagi_hasil_admin,0,',','.') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>

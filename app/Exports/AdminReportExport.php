<?php

namespace App\Exports;

use App\Models\BagiHasil;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return BagiHasil::with('penyewaan.motor')
            ->get()
            ->map(function($bh) {
                return [
                    'ID Penyewaan' => $bh->penyewaan_id,
                    'Motor' => $bh->penyewaan->motor->merk ?? '-',
                    'Tanggal' => $bh->tanggal,
                    'Pemilik' => $bh->bagi_hasil_pemilik,
                    'Admin' => $bh->bagi_hasil_admin,
                    'Total' => $bh->bagi_hasil_pemilik + $bh->bagi_hasil_admin,
                ];
            });
    }

    public function headings(): array
    {
        return ['ID Penyewaan', 'Motor', 'Tanggal', 'Pemilik', 'Admin', 'Total'];
    }
}

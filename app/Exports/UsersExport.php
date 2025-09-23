<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('id','nama','email','no_tlpn','role','created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Email', 'No Telepon', 'Role', 'Tanggal Daftar'];
    }
}

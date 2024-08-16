<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Producto;

class InventarioExport implements FromCollection
{
    public function collection()
    {
        return Producto::all();
    }
}

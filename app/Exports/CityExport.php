<?php

namespace App\Exports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CityExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'City Name'
        ];
    }

    public function collection()
    {
        return City::select('name')->get();
    }
}

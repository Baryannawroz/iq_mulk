<?php

namespace App\Imports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Str;
class CityImport implements ToModel , WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new City([
            'name' => $row[0],
            'slug' => Str::slug($row[0]).'-'.substr(rand(0,time()),0,5)
        ]);
    }
}

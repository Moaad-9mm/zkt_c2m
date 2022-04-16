<?php

namespace App\Imports;

use App\Models\PersonnelArea;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZoneImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PersonnelArea([
            'area_code'  => $row["code_zone"],
            'area_name' => $row["nome_zone"],
            'parent_area_id' => $row["superieure"],
        ]);
    }
}

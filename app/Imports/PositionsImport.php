<?php

namespace App\Imports;

use App\Models\PersonnelPosition;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PositionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PersonnelPosition([
            'position_code'  => $row["code_position"],
            'position_name' => $row["nome_position"],
            'parent_position_id' => $row["superieure"],
        ]);
    }
}

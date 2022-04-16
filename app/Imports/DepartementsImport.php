<?php

namespace App\Imports;

use App\Models\PersonnelDepartement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepartementsImport implements ToModel, WithHeadingRow
{
   
    public function model(array $row)
    {
        return new PersonnelDepartement([
            'dept_code'  => $row["code_departement"],
            'dept_name' => $row["nome_departement"],
            'parent_dept_id' => $row["superieure"],
        ]);
    }
}


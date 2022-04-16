<?php

namespace App\Imports;

use App\Models\{
    PersonnelEmploye,
    PersonnelDepartement,
    PersonnelPosition,
    PersonnelArea ,
    PersonnelEmployeeArea ,
    PayrollEmppayrollprofile };
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if ($row["code_departement"] != '') {
            $departement = PersonnelDepartement::select('id')->where('dept_code','=',$row["code_departement"])->first();
        } else {
            $departement = '1';
        }

        if ($row["code_position"] != '') {
            $position = PersonnelPosition::select('id')->where('position_code','=',$row["code_position"])->first();
        } else {
            $position = '1';
        }
        $employee =  new PersonnelEmploye([
            'emp_code'  => $row["numero_employee"],
            'first_name' => $row["prenom"],
            'last_name' => $row["nom"],
            'nickname' => $row["nom_local"],
            'gender' => $row["genre"],
            'birthday' => $row["anniversaire"],
            'contact_tel' => $row["contact_tel"],
            'office_tel' => $row["contact_bureau"],
            'mobile' => $row["mobile"],
            'national' => $row["national"],
            'religion' => $row["religion"],
            'city' => $row["ville"],
            'address' => $row["addresse"],
            'postcode' => $row["code_postal"],
            'email' => $row["email"],
            'department_id' => $departement,
            'position_id' => $position,
            // 'parent_dept_id' => $row["code_zone"],
            // 'emp_type' => $row["type_emploi"],
            'hire_date' => $row["date_embauche"],
        ]);
        if ($row["code_zone"] != "") {
            $zone = new PersonnelEmployeeArea([
                'employee_id' => $employee->id ,
                'area_id' => $row["code_zone"] ,
            ]) ;
        } else {
            $zone = new PersonnelEmployeeArea([
                'employee_id' => $employee->id ,
                'area_id' => '1' ,
            ]) ;
        }


    }
}

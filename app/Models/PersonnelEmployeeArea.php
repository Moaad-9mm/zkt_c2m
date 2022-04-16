<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
  PersonnelEmploye ,
  AttAttemployee ,
  PayrollEmppayrollprofile ,
  PersonnelEmployeeArea ,
  PersonnelEmployeeFlowRole ,
  PersonnelEmployeeprofile ,
  PersonnelEmployement ,
  PersonnelDepartement ,
  PersonnelPosition ,
  PersonnelArea ,
} ;
use Illuminate\Database\Eloquent\Relations\Pivot;
class PersonnelEmployeeArea extends Pivot
{
    use HasFactory;
    protected $table = 'personnel_employee_area';
    protected $fillable = [
        'employee_id' , 'area_id' 
      ];
    public $timestamps = false;
    
}

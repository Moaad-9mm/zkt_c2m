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

class PersonnelEmployeeFlowRole extends Model
{
    use HasFactory;
    protected $table = 'personnel_employeeprofile';
    protected $fillable = [
        'employee_id' , 'workflowrole_id' 
      ];
    public $timestamps = false;
    public function employee(){
      return $this->belongsTo(PersonnelEmploye::class ,'employee_id');
    }
}

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

class PersonnelEmployeeprofile extends Model
{
    use HasFactory;
    protected $table = 'personnel_employeeprofile';
    protected $fillable = [
        'column_order' , 'preferences' ,'pwd_update_time','emp_id','disabled_fields'
      ];
    public $timestamps = false;
    public function employee(){
      return $this->belongsTo(PersonnelEmploye::class ,'emp_id');
    }
}

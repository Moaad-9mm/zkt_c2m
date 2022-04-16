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

class AttAttemployee extends Model
{
    use HasFactory;
    protected $table = 'att_attemployee';
    protected $fillable = [
        'create_time' , 'create_user' ,'change_time','change_user','status','enable_attendance','enable_schedule',
        'enable_overtime' , 'enable_holiday','emp_id','group_id'
      ];
      public const CREATED_AT = 'create_time';
      public const UPDATED_AT = 'change_time';
      public function employee(){
        return $this->belongsTo(PersonnelEmploye::class ,'emp_id');
    }
      
}

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

class PayrollEmppayrollprofile extends Model
{
    use HasFactory;
    protected $table = 'payroll_emppayrollprofile';
    protected $fillable = [
        'payment_mode' , 'payment_type' ,'bank_name','bank_account','personnel_id','agent_id','agent_account',
        'employee_id'
      ];
    public $timestamps = false;
    public function employee(){
      return $this->belongsTo(PersonnelEmploye::class ,'employee_id');
    }
}

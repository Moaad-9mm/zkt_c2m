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

class PersonnelEmploye extends Model
{
    use HasFactory;
    protected $with = ['loadparing','pointageAujourd'] ;
    protected $table = 'personnel_employee';
    protected $fillable = [ 'create_time' , 'create_user','change_time','change_user','status','emp_code',
                            'first_name','last_name','nickname','passport','driver_license_automobile',
                            'driver_license_motorcycle','photo','self_password','device_password',
                            'dev_privilege','card_no','acc_group','acc_timezone','gender','birthday',
                            'address','postcode','office_tel','contact_tel','mobile','national','religion',
                            'title','enroll_sn','ssn','update_time','hire_date','verify_mode','city',
                            'emp_type','enable_payroll','app_status','app_role','email','last_login',
                            'is_active','session_key','login_ip','department_id','position_id','leave_group'] ;
    public const CREATED_AT = 'create_time';
    public const UPDATED_AT = 'change_time';
    
    public function department(){
    return $this->belongsTo(PersonnelDepartement::class ,'department_id');
    }
    public function position(){
        return $this->belongsTo(PersonnelPosition::class ,'position_id');
    }
    public function employment_type(){
        return $this->hasOne(PersonnelEmployement::class,'employee_id');
    }
    public function area(){
        return $this->belongsToMany(PersonnelArea::class,'personnel_employee_area','employee_id' ,'area_id');
    }
    public function att_employee(){
        return $this->hasOne(AttAttemployee::class,'emp_id');
    }
    public function payment(){
        return $this->hasOne(PayrollEmppayrollprofile::class,'employee_id');
    }
    public function loadparing()
    {
        return $this->hasMany(AttPayloadparing::class, 'emp_id');
    }
    public function pointageAujourd()
    {
        return $this->hasMany(AttPayLoadTimeCard::class, 'emp_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelDepartement extends Model
{
    use HasFactory;
    protected $fillable = [
        'dept_code' , 'dept_name' ,'parent_dept_id' , 'is_default'
      ];
   
    protected $table = 'personnel_department';
    public $timestamps = false;
    public function parent()
    {
        return $this->belongsTo(PersonnelDepartement::class,'parent_dept_id');
    }

    public function children()
    {
        return $this->hasMany(PersonnelDepartement::class, 'parent_dept_id');
    }
    public function employee()
    {
        return $this->hasMany(PersonnelEmploye::class, 'department_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelArea extends Model
{
    use HasFactory;
    protected $table = 'personnel_area';
    protected $fillable = [
        'area_code' , 'area_name' ,'parent_area_id' , 'is_default'
      ];
    public $timestamps = false;
    public function parent()
    {
        return $this->belongsTo(PersonnelArea::class,'parent_area_id');
    }

    public function children()
    {
        return $this->hasMany(PersonnelArea::class, 'parent_area_id');
    }
    public function employee()
    {
        return $this->belongsToMany(PersonnelEmploye::class,'personnel_employee_area', 'area_id' ,'employee_id' );
    }
}

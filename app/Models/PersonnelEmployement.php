<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelEmployement extends Model
{
    use HasFactory;
    protected $table = 'personnel_employment';
    protected $fillable = [
        'employment_type' , 'start_date' ,'end_date','active_time','inactive_time' ,'employee_id' 
      ];
    public $timestamps = false;
    public function employee(){
      return $this->belongsTo(PersonnelEmploye::class ,'employee_id');
    }
}

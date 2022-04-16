<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelResign extends Model
{
    use HasFactory;
    protected $table = 'personnel_resign';
    protected $fillable = [
        'resign_date' , 'resign_type' ,'disableatt' , 'reason' , 'employee_id'
      ];
    public $timestamps = false;
    public function employee(){
      return $this->belongsTo(PersonnelEmploye::class ,'employee_id');
      }
}

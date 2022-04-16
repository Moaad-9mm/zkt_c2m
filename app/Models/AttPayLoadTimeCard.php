<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttPayLoadTimeCard extends Model
{
    use HasFactory;
    protected $table = 'att_payloadtimecard';
    protected $fillable = [
        'att_date' , 'week' ,'weekday','date_type','time_table_alias','check_in','check_out',
        'work_day' ,'clock_in','clock_out','break_out','break_in','lock_down',
        'emp_id','time_table_id','present'
      ];
      public function employee(){
        return $this->belongsTo(PersonnelEmploye::class ,'emp_id');
        }
}

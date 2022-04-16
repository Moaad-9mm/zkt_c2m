<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttPayloadparing extends Model
{
    use HasFactory;
    // protected $with = ['employee'] ;
    protected $table = 'att_payloadparing';
    protected $fillable = [
        'stamp' , 'att_date' ,'week','weekday','data_type','clock_in','in_date',
        'in_time' ,'clock_out','out_date','out_time','duration','worked_duration',
        'data_index','workday','emp_id','in_trans_id','out_trans_id','pay_code_id','time_card_id'
      ];
      public function employee(){
        return $this->belongsTo(PersonnelEmploye::class ,'emp_id');
        }
}

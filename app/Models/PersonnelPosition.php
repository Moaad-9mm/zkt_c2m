<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelPosition extends Model
{
    use HasFactory;
    protected $fillable = [
        'position_code' , 'position_name' ,'parent_position_id' , 'is_default'
      ];
    protected $table = 'personnel_position';
    public $timestamps = false;
    public function parent()
    {
        return $this->belongsTo(PersonnelPosition::class,'parent_position_id');
    }

    public function children()
    {
        return $this->hasMany(PersonnelPosition::class, 'parent_position_id');
    }
    public function employee()
    {
        return $this->hasMany(PersonnelEmploye::class, 'position_id');
    }
}

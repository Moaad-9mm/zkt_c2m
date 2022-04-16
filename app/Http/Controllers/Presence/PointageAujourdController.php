<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\{
    PersonnelEmploye ,
    AttAttemployee ,
    PayrollEmppayrollprofile ,
    PersonnelEmployeeArea ,
    PersonnelEmployeeFlowRole ,
    PersonnelEmployeeprofile ,
    PersonnelEmployement ,
    PersonnelPosition ,
    PersonnelDepartement ,
    PersonnelArea ,
    PersonnelResign ,
    AttPayloadparing ,
} ;
use Carbon\Carbon;

class PointageAujourdController extends Controller
{
    public function index(){
        $zones = PersonnelArea::all() ;
        $positions = PersonnelPosition::all() ;
        $departements = PersonnelDepartement::all() ;
        return view('presence.pointage-aujourd' ,compact('zones','positions','departements')) ;
    }
    public function search(Request $request){
        $position_id = $request->position_id ;
        $departement_id = $request->departement_id ;
        // $today =  Carbon::now();
        $today =  "2022-01-18";
        $employeePresent = PersonnelEmploye::whereHas('pointageAujourd' , function (Builder $query)  use($today){
            $query->where('att_date','=',$today) ;
        })->where('status','=','0')->get() ;
        $ids = collect() ;
            foreach ($employeePresent as $emp) {
                $ids->push($emp->id) ;
            }
        $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids)->where('status','=','0')->get();
        if ($departement_id != '0') {
            $employeePresent = PersonnelEmploye::whereHas('pointageAujourd' , function (Builder $query)  use($today){
                $query->where('att_date','=',$today) ;
            })->where('status','=','0')->where('department_id' , '=' ,$departement_id)->get() ;
            $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids )->where('status','=','0')->where('department_id' , '=' ,$departement_id)->get();
        }
        if ($position_id != '0') {
            $employeePresent = PersonnelEmploye::whereHas('pointageAujourd' , function (Builder $query)  use($today){
                $query->where('att_date','=',$today) ;
            })->where('status','=','0')->where('position_id' , '=' ,$position_id)->get() ;
            $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids )->where('status','=','0')->where('position_id' , '=' ,$position_id)->get();
        }
        if ($departement_id != '0' && $position_id != '0') {
            $employeePresent = PersonnelEmploye::whereHas('pointageAujourd' , function (Builder $query)  use($today){
                $query->where('att_date','=',$today) ;
            })->where('position_id' , '=' ,$position_id)->where('status','=','0')->where('department_id' , '=' ,$departement_id)->get() ;
            $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids )->where('status','=','0')->where('position_id' , '=' ,$position_id)->where('department_id' , '=' ,$departement_id)->get();
            
        }

        return response()->json([
            'employeeAbsent' => $employeeAbsent,
            'employeePresent' => $employeePresent,
        ]);
        

    }
}

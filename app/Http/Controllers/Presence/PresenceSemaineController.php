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

class PresenceSemaineController extends Controller
{
    public function index(){
        $zones = PersonnelArea::all() ;
        $positions = PersonnelPosition::all() ;
        $departements = PersonnelDepartement::all() ;
        return view('presence.presence-semaine' ,compact('zones','positions','departements')) ;
    }
    public function search(Request $request){
        $date_debut = $request->date_debut ;
        $position_id = $request->position_id ;
        $departement_id = $request->departement_id ;
        $date_fin = date('Y-m-d', strtotime($date_debut.' + 6 days'));
        $employeePresent = PersonnelEmploye::whereHas('loadparing' , function (Builder $query)  use($date_debut,$date_fin){
            $query->where('att_date', [$date_debut,$date_fin])->where('duration','>',0) ;
        })->where('status','=','0')->get() ;

        $ids = collect() ;
            foreach ($employeePresent as $emp) {
                $ids->push($emp->id) ;
            }
        $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids )->where('status','=','0')->get();
        if ($departement_id != '0') {
            $employeePresent = PersonnelEmploye::whereHas('loadparing' , function (Builder $query)  use($date_debut,$date_fin){
                $query->where('att_date', [$date_debut,$date_fin])->where('duration','>',0) ;
            })->where('status','=','0')->where('department_id' , '=' ,$departement_id)->get() ;
            $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids )->where('status','=','0')->where('department_id' , '=' ,$departement_id)->get();
        }
        if ($position_id != '0') {
            $employeePresent = PersonnelEmploye::whereHas('loadparing' , function (Builder $query)  use($date_debut,$date_fin){
                $query->where('att_date', [$date_debut,$date_fin])->where('duration','>',0) ;
            })->where('status','=','0')->where('position_id' , '=' ,$position_id)->get() ;
            $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids )->where('status','=','0')->where('position_id' , '=' ,$position_id)->get();
        }
        if ($departement_id != '0' && $position_id != '0') {
            $employeePresent = PersonnelEmploye::whereHas('loadparing' , function (Builder $query)  use($date_debut,$date_fin){
                $query->where('att_date', [$date_debut,$date_fin])->where('duration','>',0) ;
            })->where('status','=','0')->where('position_id' , '=' ,$position_id)->where('department_id' , '=' ,$departement_id)->get() ;
            $employeeAbsent = PersonnelEmploye::whereNotIn('id' ,$ids )->where('status','=','0')->where('position_id' , '=' ,$position_id)->where('department_id' , '=' ,$departement_id)->get();
        }

        $date1 = date('Y-m-d', strtotime($date_debut. ' + 1 days'));
        $date2 = date('Y-m-d', strtotime($date_debut. ' + 2 days'));
        $date3 = date('Y-m-d', strtotime($date_debut. ' + 3 days'));
        $date4 = date('Y-m-d', strtotime($date_debut. ' + 4 days'));
        $date5 = date('Y-m-d', strtotime($date_debut. ' + 5 days'));
        return response()->json([
            'date_debut' => $date_debut,
            'date1' => $date1,
            'date2' => $date2,
            'date3' => $date3,
            'date4' => $date4,
            'date5' => $date5,
            'date_fin' => $date_fin,
            'employeeAbsent' => $employeeAbsent,
            'employeePresent' => $employeePresent,
        ]);
    }
}

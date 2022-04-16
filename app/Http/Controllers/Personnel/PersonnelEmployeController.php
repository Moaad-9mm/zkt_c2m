<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
} ;
use Response ;

class PersonnelEmployeController extends Controller
{
    public function index(){
        $employees = PersonnelEmploye::where('status','=','0')->get();
        $last = PersonnelEmploye::all()->last();
        $positions = PersonnelPosition::all();
        $departements = PersonnelDepartement::all() ;
        $zones = PersonnelArea::all();
        return view('personnel.employe',compact('employees','last','positions','departements','zones'));
    }
    public function store(Request $request){
         $employee = PersonnelEmploye::create($request->all() + ['status' => 0] );
         if ($request->area_id) {
            PersonnelEmployeeArea::create([
                'employee_id' => $employee->id ,
                'area_id' => $request->area_id]) ;
         }
         if ($request->emp_type == '2' || $request->emp_type == '3') {
            PersonnelEmployement::create([
                'employment_type' => $request->emp_type ,
                'start_date' => $request->start_date ,
                'end_date' => $request->end_date ,
                'employee_id' => $employee->id 
                ]) ;
         }
         AttAttemployee::create([
             'enable_attendance'=>$request->enable_attendance,
             'enable_schedule'=>$request->enable_schedule,
             'enable_overtime'=>$request->enable_overtime,
             'enable_holiday'=>$request->enable_holiday ,
             'emp_id'=>$employee->id 
         ]);
         PayrollEmppayrollprofile::create([
            'payment_mode'=>$request->payment_mode,
            'payment_type'=>$request->payment_type,
            'bank_name'=>$request->bank_name,
            'bank_account'=>$request->bank_account ,
            'personnel_id'=>$request->personnel_id ,
            'agent_id'=>$request->agent_id ,
            'agent_account'=>$request->agent_account ,
            'employee_id'=>$employee->id 
         ]) ;
         $dept_name = $employee->department->dept_name ;
         if ($employee->position) {
            $pos_name = $employee->position->position_name ;
         } else {
            $pos_name = '' ;
         }
         
         $area_name = $employee->area->first()->area_name ;

        return response()->json([
            'employee' => $employee,
            'pos_name' => $pos_name ,
            'area_name' => $area_name ,
            'dept_name' => $dept_name ,
        ]); 
    }
    public function edit($id){
        $employee = PersonnelEmploye::where('id','=',$id)->first();
        
        if ($employee->area) {
            $area=$employee->area->first() ;
        }else{
            $area = "-" ;
        }
        if ($employee->emp_type == '2' || $employee->emp_type == '3') {
            $employment_type = $employee->employment_type ;
        }else{
            $employment_type = "-" ;
        }
        $att_employee = $employee->att_employee ;
        $payment = $employee->payment ;
        return response()->json([
            'employee' => $employee,
            'area' => $area,
            'employment_type' => $employment_type,
            'att_employee' => $att_employee,
            'payment' => $payment,
            
        ]);         
  
    }
    public function update(Request $request , $id) {
        $employee = PersonnelEmploye::where('id','=',$id)->first();
        $employee->update($request->all()) ;
        if ($request->area_id) {
            // $employee->area->first()->updateExistingPivot($request->area_id) ;
            // $employee->area->update([
            //     'area_id' => $request->area_id]) ;
            $area = PersonnelEmployeeArea::where('employee_id','=',$employee->id)->first();
            $area->area_id = $request->area_id ;
            $area->save() ;
         }
         if ($request->emp_type == '2' || $request->emp_type == '3') {
            $employee->employment_type->update([
                'employment_type' => $request->emp_type ,
                'start_date' => $request->start_date ,
                'end_date' => $request->end_date ,
                ]) ;
         }
         $employee->att_employee->update([
            'enable_attendance'=>$request->enable_attendance,
            'enable_schedule'=>$request->enable_schedule,
            'enable_overtime'=>$request->enable_overtime,
            'enable_holiday'=>$request->enable_holiday ,
        ]);
        $employee->payment->update([
           'payment_mode'=>$request->payment_mode,
           'payment_type'=>$request->payment_type,
           'bank_name'=>$request->bank_name,
           'bank_account'=>$request->bank_account ,
           'personnel_id'=>$request->personnel_id ,
           'agent_id'=>$request->agent_id ,
           'agent_account'=>$request->agent_account ,
        ]) ;
        $position = $employee->position ;
        $departement = $employee->department ;
        $zone = $employee->area->first() ;
        return response()->json([
            'employee' => $employee ,
            'position' => $position ,
            'departement' => $departement ,
            'zone' => $zone ,
        ]) ;

    }
    public function destroy(Request $request){
        $employee = PersonnelEmploye::where('id','=',$request->id)->first() ;
        if ($employee->area) {
            $employee->employee_area->delete() ;
        }
        if ($employee->emp_type == '2' || $employee->emp_type == '3') {
            $employee->employment_type->delete() ;
         }
         $employee->att_employee->delete() ;
         $employee->payment->delete() ;
         $employee->delete() ;
         return Response::json($employee);

    }
}

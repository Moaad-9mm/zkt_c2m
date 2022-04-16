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
    PersonnelResign ,
} ;

class PersonnelDemissionerController extends Controller
{
    public function index(){
        $demissionnes  = PersonnelResign::all() ;
        $employees  = PersonnelEmploye::where('status','=','0')->get();
        return view('personnel.demissionner' ,compact('demissionnes','employees')) ;
    }
    public function store(Request $request){
        $employee = PersonnelEmploye::where('id','=',$request->employee_id)->first();
        $employee->update([
            'status' => '99' ,
        ]);
        $demissionne = PersonnelResign::create($request->all()) ;
        if ($employee->department) {
            $dept_name = $employee->department->dept_name ;
        } else {
            $dept_name ='-' ;
        }
        if ($employee->position) {
            $position_name = $employee->position->position_name ;
        } else {
            $position_name ='-' ;
        }
        return response()->json([
            'employee' => $employee ,
            'demissionne' => $demissionne ,
            'dept_name' => $dept_name ,
            'position_name' => $position_name ,
            // 'request'=> $request->all() ,
        ]) ;
    }

    public function edit($id){
        $demissionne = PersonnelResign::where('id','=',$id)->first();
        return response()->json([
            'demissionne' => $demissionne ,
        ]) ;
    }
    public function update(Request $request , $id){
        $demissionne = PersonnelResign::where('id','=',$id)->first() ;
        $demissionne->update($request->all());
        $employee = $demissionne->employee ;
        if ($demissionne->employee->department) {
            $dept_name = $demissionne->employee->department->dept_name ;
        } else {
            $dept_name = "-" ;
        }
        if ($demissionne->employee->position) {
            $position_name = $demissionne->employee->position->position_name ;
        } else {
            $position_name = "-" ;
        }
        return response()->json([
            'demissionne' => $demissionne ,
            'employee' => $employee ,
            'dept_name' => $dept_name ,
            'position_name' => $position_name ,
        ]) ;
    }

    public function destroy(Request $request){
        $demissionne = PersonnelResign::where('id','=',$request->id)->first() ;
        $employee = PersonnelEmploye::where('id','=',$demissionne->employee_id)->first();
        $employee->update([
            'status' => '0'
        ]) ;
        $demissionne->delete() ;
        return response()->json([
            'demissionne' => $demissionne ,
        ]) ;

    }
}

<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonnelDepartement ;
use Response ;

class PersonnelDepartementController extends Controller
{
    public function index(){
        $departements = PersonnelDepartement::all();
        $last = PersonnelDepartement::select('*')->orderByDesc("id")->first() ;
        return view('personnel.departement',compact('departements'),compact('last'));
    }
    public function store(Request $request){
        $dpt = new PersonnelDepartement();
        $dpt->dept_code = $request->dept_code;
        $dpt->dept_name = $request->dept_name;
        if ($request->parent_dept_id != 0) {
            $dpt->parent_dept_id = $request->parent_dept_id;
            $parent = PersonnelDepartement::select('dept_name')->where('id','=',$request->parent_dept_id)->get() ;
        }
        $qteEmp = $dpt->employee->where('status','=','0')->count() ;
        $qteDem = $dpt->employee->where('status','=','99')->count() ;
        $dpt->save();
        return response()->json([
            'dpt' => $dpt,
            'parent' => $parent,
            'qteEmp' => $qteEmp ,
            'qteDem' => $qteDem ,
        ]);
    }
    public function update(Request $request){
        $dpt = PersonnelDepartement::find($request->id) ;
        $dpt->update($request->all()) ;
        return Response::json($dpt);
    }
    public function destroy(Request $request){
        $dpt = PersonnelDepartement::find($request->id) ;
        $dpt->delete();
        return Response::json($dpt);
    }
}

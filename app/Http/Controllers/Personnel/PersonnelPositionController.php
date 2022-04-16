<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonnelPosition ;
use Response ;

class PersonnelPositionController extends Controller
{
    public function index(){
        $positions = PersonnelPosition::all();
        $last = PersonnelPosition::select('*')->orderByDesc("id")->first() ;
        return view('personnel.position',compact('positions','last'));
    }
    public function store(Request $request){
        $pos = new PersonnelPosition();
        $pos->position_code = $request->position_code;
        $pos->position_name = $request->position_name;
        if ($request->parent_position_id != 0) {
            $pos->parent_position_id = $request->parent_position_id;
            $parent = PersonnelPosition::select('position_name')->where('id','=',$request->parent_position_id)->get() ;
        }
        $qteEmp = $pos->employee->where('status','=','0')->count() ;
        $qteDem = $pos->employee->where('status','=','99')->count() ;
        $pos->save();
        return response()->json([
            'pos' => $pos,
            'parent' => $parent,
            'qteEmp' => $qteEmp ,
            'qteDem' => $qteDem ,
        ]);
    }
    public function update(Request $request){
        $pos = PersonnelPosition::find($request->id) ;
        $pos->update($request->all()) ;
        return Response::json($pos);
    }
    public function destroy(Request $request){
        $pos = PersonnelPosition::find($request->id) ;
        $pos->delete();
        return Response::json($pos);
    }
}

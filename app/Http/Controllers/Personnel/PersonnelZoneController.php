<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonnelArea ;
use Response ;

class PersonnelZoneController extends Controller
{
    public function index(){
        $zones = PersonnelArea::all();
        $last = PersonnelArea::select('*')->orderByDesc("id")->first() ;
        return view('personnel.zone',compact('zones','last'));
    }
    public function store(Request $request){
        $zone = new PersonnelArea();
        $zone->area_code = $request->area_code;
        $zone->area_name = $request->area_name;
        if ($request->parent_area_id != 0) {
            $zone->parent_area_id = $request->parent_area_id;
             $parent = PersonnelArea::select('area_name')->where('id','=',$request->parent_area_id)->get() ;
        }
        $zone->save();
        $qteEmp = $zone->employee->where('status','=','0')->count() ;
        $qteDem = $zone->employee->where('status','=','99')->count() ;
        return response()->json([
            'zone' => $zone,
            'parent' => $parent,
            'qteEmp' => $qteEmp,
            'qteDem' => $qteDem,
        ]);
    }
    public function update(Request $request){
        $zone = PersonnelArea::find($request->id) ;
        $zone->update($request->all()) ;
        return Response::json($zone);
    }
    public function destroy(Request $request){
        $zone = PersonnelArea::find($request->id) ;
        $zone->delete();
        return Response::json($zone);
    }
}

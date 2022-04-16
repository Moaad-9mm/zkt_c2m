<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\DepartementExport;
use App\Imports\DepartementsImport;
use Maatwebsite\Excel\Facades\Excel;

class DepartementExportController extends Controller
{
    public function export() 
    {
        return Excel::download(new DepartementExport, 'departements.xlsx');
    }
    public function import(Request $request){
        Excel::import(new DepartementsImport, $request->file('departementFile')->store('temp'));
        return redirect()->route('departements.index') ; 
    }
}

<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PositionsExport;
use App\Imports\PositionsImport;

class PositionExportImportController extends Controller
{
    public function export() 
    {
        return Excel::download(new PositionsExport, 'positions.xlsx');
    }
    public function import(Request $request){
        Excel::import(new PositionsImport, $request->file('positionsFile')->store('temp'));
        return redirect()->route('positions.index') ; 
    }
}

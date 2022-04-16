<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ZoneExport;
use App\Imports\ZoneImport;


class ZoneExportImportController extends Controller
{
    public function export() 
    {
        return Excel::download(new ZoneExport, 'zones.xlsx');
    }
    public function import(Request $request){
        Excel::import(new ZoneImport, $request->file('zoneFile')->store('temp'));
        return redirect()->route('zones.index') ; 
    }
}

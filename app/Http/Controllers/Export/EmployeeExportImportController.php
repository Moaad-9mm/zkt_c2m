<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
// use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeExportImportController extends Controller
{
    public function export() 
    {
        return Excel::download(new EmployeeExport, 'employees.xlsx');
    }
}

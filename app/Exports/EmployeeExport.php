<?php

namespace App\Exports;

use App\Models\PersonnelEmploye;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeeExport implements FromView
{
    public function view(): View
    {
        return view('exports.employees', [
            'employees' => PersonnelEmploye::where('status','=','0')->get() ,
        ]);
    }
}

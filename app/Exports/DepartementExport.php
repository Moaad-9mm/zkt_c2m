<?php

namespace App\Exports;

use App\Models\PersonnelDepartement;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DepartementExport implements FromView
{
    public function view(): View
    {
        return view('exports.departements', [
            'departements' => PersonnelDepartement::all()
        ]);
    }
}




<?php

namespace App\Exports;

use App\Models\PersonnelArea;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ZoneExport implements FromView
{
    public function view(): View
    {
        return view('exports.zones', [
            'zones' => PersonnelArea::all()
        ]);
    }
}

<?php

namespace App\Exports;

use App\Models\PersonnelPosition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PositionsExport implements FromView
{
    public function view(): View
    {
        return view('exports.positions', [
            'positions' => PersonnelPosition::all()
        ]);
    }
}

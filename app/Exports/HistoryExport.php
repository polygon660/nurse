<?php

namespace App\Exports;

use App\Models\guest_type;
use App\Models\history;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HistoryExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('export.HistoryExcel', [
            'data' => history::with(['guest'])->orderby('id', 'desc')->get()
        ]);
    }
}

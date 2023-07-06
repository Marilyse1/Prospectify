<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProspectsExport;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $number = 0;
        $reports = Prospect::where('sale_concluded', true)->get();
        return view('reports.index', compact([
            'reports',
            'number',
        ]));
    }

    public function filter(Request $request)
    {
        $number = 0;
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $start_date = $validatedData['start_date'];
        $end_date = $validatedData['end_date'];

        $reports = Prospect::whereBetween('date', [$start_date, $end_date])
            ->where('sale_concluded', true)
            ->get();

        return view('reports.filter', compact([
            'reports', 
            'start_date', 
            'end_date',
            'number'
        ]));
    }

    public function export(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $start_date = $validatedData['start_date'];
        $end_date = $validatedData['end_date'];

        return Excel::download(new ProspectsExport($start_date, $end_date), 'prospects.xlsx');
    }
}

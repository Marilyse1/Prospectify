<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $prospects = Prospect::all();
        $totalSales = Prospect::where('sale_concluded', true)->get();
        return view('home', compact([
            'prospects',
            'totalSales',
        ]));
    }
}

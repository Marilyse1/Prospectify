<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $number = 0;
        $prospects = Prospect::all();
        $totalSales = Prospect::where('sale_concluded', true)->get();
        return view('index', compact([
            'prospects',
            'totalSales',
            'number',
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agent_name' => 'required|string',
            'client_name' => 'required|string',
            'client_address' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:heure_debut',
            'product' => 'required|string',
            'observations' => 'required',
            //'sale_concluded' => 'false',
        ]);

        if (!$request->sale_concluded) {
            $request->sale_concluded = 0;
        }

        Prospect::create(['agent_name' => $request->agent_name,
        'client_name' => $request->client_name,
        'client_address' => $request->client_address,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'product' => $request->product,
        'duration' => $request->duration,
        'observations' => $request->observations,
        'sale_concluded' => $request->sale_concluded,
        ]);

        return redirect()->route('home')->with('success', 'Le prospect a été ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'agent_name' => 'required|string',
            'client_name' => 'required|string',
            'client_address' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'product' => 'required|string',
            'observations' => 'required',
            //'sale_concluded' => 'required|boolean',
        ]);

        /*if ($request->sale_concluded != 1) {
            $request->sale_concluded = 0;
        }*/

        if (!$request->sale_concluded) {
            $request->sale_concluded = 0;
        }

        $prospects = Prospect::whereId($id)->update([
            'agent_name' => $request->agent_name,
            'client_name' => $request->client_name,
            'client_address' => $request->client_address,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'product' => $request->product,
            //'duration' => $request->duration,
            'observations' => $request->observations,
            'sale_concluded' => $request->sale_concluded,]);

        return redirect()->route('home')->with('success', 'Le prospect a été mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $prospect = Prospect::findOrFail($id);
        $prospect->delete();
        $prospects = Prospect::all();
        return redirect()->route('home')->with('success', 'Le prospect a été mis à jour avec succès.');
        //return view('home', compact('prospects'))->with('success', 'Le prospect a été supprimé avec succès.');
    }
}

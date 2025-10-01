<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Pharmacie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware(['auth', 'check.ville'])->only(['show', 'edit', 'update', 'destroy']);
     }


    public function index()
{
    $villeId = Auth::user()->ville_id;

    // Récupérer toutes les pharmacies des communes de la ville
    $pharmacies = Pharmacie::whereHas('commune', function ($query) use ($villeId) {
        $query->where('ville_id', $villeId);
    })->get();

    return view('pharmacies.index', compact('pharmacies'));
}

public function getByCommune($communeId)
    {
        $pharmacies = Pharmacie::where('commune_id', $communeId)->get();
        return response()->json($pharmacies);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villeId = Auth::user()->ville_id;
        $communes = Commune::where('ville_id', $villeId)->get();

        return view('pharmacies.create', compact('communes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        $request->validate([
            'name_pharmacie' => 'required|string|max:255',
            'commune_id' => 'required|exists:communes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
        ]);

        $villeId = Auth::user()->ville_id;
        $commune = Commune::where('id', $request->commune_id)
                          ->where('ville_id', $villeId)
                          ->firstOrFail();

        Pharmacie::create([
            'name_pharmacie' => $request->name_pharmacie,
            'commune_id' => $commune->id,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('pharmacies.index')
                         ->with('success', 'Pharmacie créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */
    // public function show($villeId, $communeId, $id)
    // {
    //     $commune = Commune::where('ville_id', $villeId)->findOrFail($communeId);
    //     $pharmacie = $commune->pharmacies()->findOrFail($id);

    //     return view('pharmacies.show', compact('pharmacie', 'commune'));
    // }

    public function show($id)
    {

        $pharmacie = Pharmacie::findOrFail($id);
        return view('pharmacies.show', compact('pharmacie'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $villeId = Auth::user()->ville_id;
        $pharmacie = Pharmacie::whereHas('commune', function($q) use($villeId) {
            $q->where('ville_id', $villeId);
        })->findOrFail($id);

        $communes = Commune::where('ville_id', $villeId)->get();

        return view('pharmacies.edit', compact('pharmacie', 'communes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_pharmacie' => 'required|string|max:255',
            'commune_id' => 'required|exists:communes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
        ]);

        $villeId = Auth::user()->ville_id;
        $pharmacie = Pharmacie::whereHas('commune', function($q) use($villeId) {
            $q->where('ville_id', $villeId);
        })->findOrFail($id);

        $commune = Commune::where('id', $request->commune_id)
                          ->where('ville_id', $villeId)
                          ->firstOrFail();

        $pharmacie->update([
            'name_pharmacie' => $request->name_pharmacie,
            'commune_id' => $commune->id,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('pharmacies.index')
                         ->with('success', 'Pharmacie mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $villeId = Auth::user()->ville_id;
        $pharmacie = Pharmacie::whereHas('commune', function($q) use($villeId) {
            $q->where('ville_id', $villeId);
        })->findOrFail($id);

        $pharmacie->delete();

        return redirect()->route('pharmacies.index')
                         ->with('success', 'Pharmacie supprimée avec succès.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Info;

use App\Models\Programe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgrameController extends Controller
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
    $programmes = Programe::where('ville_id', $villeId)->get();
    // Prendre seulement le premier enregistrement pour la ville


    return view('programmes.index', compact('programmes'));
}


public function par()
{
    $villeId = Auth::user()->ville_id;

    // Récupérer toutes les pharmacies des communes de la ville
    $programmes = Programe::whereHas('commune', function ($query) use ($villeId) {
        $query->where('ville_id', $villeId);
    })->get();

    return view('programmes.para', compact('programmes'));
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

        return view('programmes.create', compact('communes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'commune_id' => 'required|exists:communes,id',
        'pharmacies' => 'required|array',
        'pharmacies.*' => 'exists:pharmacies,id',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'is_garde' => 'nullable|boolean',
    ]);

    $programme = Programe::create([
        'commune_id' => $validated['commune_id'],
        'date_debut' => $validated['date_debut'],
        'date_fin' => $validated['date_fin'],
        'is_garde' => $request->has('is_garde'),
    ]);

    // Attacher les pharmacies sélectionnées
    $programme->pharmacies()->attach($validated['pharmacies']);

    return redirect()->route('programmes.index')->with('success', 'Programme enregistré avec succès.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programe  $programe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $programme = Programe::with('pharmacie.commune.ville')->findOrFail($id);

    return view('programmes.show', compact('programme'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programe  $programe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $villeId = auth()->user()->ville_id;

        $programme = Programe::with('pharmacies')->findOrFail($id);

        // Vérifie que le programme est bien dans la ville de l’utilisateur
        if ($programme->commune->ville_id != $villeId) {
            abort(403, "Accès interdit à ce programme.");
        }

        $communes = Commune::where('ville_id', $villeId)->get();
        $selectedPharmacies = $programme->pharmacies->pluck('id')->toArray();
        // $pharmacies = Pharmacie::whereHas('commune', function($q) use ($villeId) {
        //     $q->where('ville_id', $villeId);
        // })->get();
        return view('programmes.edit', compact('programme', 'communes', 'selectedPharmacies'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'commune_id' => 'required|exists:communes,id',
            'pharmacies' => 'required|array',
            'pharmacies.*' => 'exists:pharmacies,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'is_garde' => 'nullable|boolean',
        ]);

        $programme = Programe::findOrFail($id);

        $programme->update([
            'commune_id' => $validated['commune_id'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'is_garde' => $request->has('is_garde'),
        ]);

        // Synchroniser les pharmacies
        $programme->pharmacies()->sync($validated['pharmacies']);

        return redirect()->route('programmes.index')->with('success', 'Programme mis à jour avec succès.');
    }

   // app/Http/Controllers/ProgrameController.php
public function search(Request $request)
{
    $villeId = auth()->user()->ville_id;
    $info = Info::where('ville_id', $villeId)->first();
    $query = Programe::with(['pharmacies.commune'])
        ->whereHas('commune', function($q) use ($villeId) {
            $q->where('ville_id', $villeId);
        });

    if ($request->filled('date_debut') && $request->filled('date_fin')) {
        $query->where(function($q) use ($request) {
            $q->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
              ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin]);
        });
    }

    $programmes = $query->get();

    return view('programmes.search', compact('programmes','info'));
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programe  $programe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programe $programe)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
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
        // ✅ Montrer seulement les communes de la ville de l’utilisateur
        $communes = Commune::where('ville_id', auth()->user()->ville_id)->get();

        return view('communes.index', compact('communes'));
    }


    public function create()
    {
        return view('communes.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_commune' => 'required|string|max:255',
        ]);

        Commune::create([
            'name_commune' => $request->name_commune,
            'ville_id' => auth()->user()->ville_id, // ville par défaut depuis l'inscription
        ]);

        return redirect()->route('communes.index')->with('success', 'Commune créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function show(Commune $commune)
    {
        return view('communes.show', compact('commune'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function edit(Commune $commune)
    {
        
        return view('communes.edit', compact('commune'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commune $commune)
    {
        $request->validate([
            'name_commune' => 'required|string|max:255',
        ]);

        $commune->update([
            'name_commune' => $request->name_commune,
        ]);

        return redirect()->route('communes.index')->with('success', 'Commune mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commune $commune)
    {
        $commune->delete();

        return redirect()->route('communes.index')->with('success', 'Commune supprimée avec succès');
    }
}

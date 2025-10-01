<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villes = Ville::all();
        return view('villes.index', compact('villes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('villes.create');
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
            'name_ville' => 'required|string|max:255|unique:villes,name_ville',
        ]);

        Ville::create(['name_ville' => $request->name_ville]);

        return redirect()->route('villes.index')->with('success', 'Ville créée avec succès.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ville = Ville::findOrFail($id);
        return view('villes.show', compact('ville'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ville = Ville::findOrFail($id);
        return view('villes.edit', compact('ville'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ville = Ville::findOrFail($id);

        $request->validate([
            'name_ville' => 'required|string|max:255|unique:villes,name_ville,' . $ville->id,
        ]);

        $ville->update(['name_ville' => $request->name_ville]);

        return redirect()->route('villes.index')->with('success', 'Ville mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ville = Ville::findOrFail($id);
        $ville->delete();

        return redirect()->route('villes.index')->with('success', 'Ville supprimée avec succès.');
    }
}

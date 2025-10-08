<?php

namespace App\Http\Controllers;

use App\Models\Programe;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function ville($villeId)
{

    $villeId = Auth::user()->ville_id;

    // ✅ Récupérer uniquement le dernier programme publié dans la ville de l'utilisateur
    $programme = Programe::where('ville_id', $villeId)
        ->where('is_publish', true)
        ->orderByDesc('published_at')
        ->first();
    $ville = Ville::findOrFail($villeId);
    return view('apres.ville', compact('ville','programme'));
}

public function inf($villeId)
{

    $ville = Ville::findOrFail($villeId);
    return view('apres.infos' , compact('ville'));
}

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

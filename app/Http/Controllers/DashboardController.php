<?php

namespace App\Http\Controllers;

use App\Models\Programe;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
// ✅ Téléchargements par utilisateur dans la ville
$downloadsPerUser = DB::table('downloads')
->join('users', 'users.id', '=', 'downloads.user_id')
->where('downloads.ville_id', $villeId)
->select('users.name', DB::raw('SUM(downloads.total_downloads) as total'))
->groupBy('users.name')
->orderByDesc('total')
->get();

// ✅ Évolution mensuelle pour toute la ville
$downloadsByMonth = DB::table('downloads')
->where('ville_id', $villeId)
->where('year', now()->year)
->selectRaw('month, SUM(total_downloads) as total')
->groupBy('month')
->orderBy('month')
->pluck('total', 'month');

    // ✅ Récupérer uniquement le dernier programme publié dans la ville de l'utilisateur
    $programme = Programe::where('ville_id', $villeId)
        ->where('is_publish', true)
        ->orderByDesc('published_at')
        ->first();

    $ville = Ville::findOrFail($villeId);
    
    return view('apres.ville', compact('ville','programme', 'downloadsPerUser','downloadsByMonth'));
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

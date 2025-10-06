<?php

namespace App\Http\Controllers;



use App\Models\Programe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\ProgrammePublishedNotification;

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
    $programmes = Programe::all();
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
       // $communes = Commune::where('ville_id', $villeId)->get();
       //$info = Programe::where('ville_id', $villeId)->get();
        return view('programmes.create');
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
             'name'      => 'required|string|max:255',
             'image_one' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx',
         ]);

         $filePath = null;
    if ($request->hasFile('image_one')) {
        $filePath = $request->file('image_one')->store('infosimages', 'public');
    }
        // dd($filePath);
         Programe::create([
             'name'       => $validated['name'],
             'image_one'  => $filePath, // ✅ chemin correct
             'is_publish' => false,
             'user_id'    => auth()->id(),
             'ville_id'   => auth()->user()->ville_id,
         ]);

         return redirect()->route('programmes.index')
             ->with('success', 'Programme créé avec succès.');
     }


     public function download(Programe $programme)
     {
        if ($programme->image_one && Storage::disk('public')->exists($programme->image_one)) {
            return Storage::disk('public')->download($programme->image_one);
        }
        return back()->with('error', 'Aucun fichier disponible.');

     }



     public function publish(Programe $programme)
     {
         // ✅ Publier
         $programme->update([
            'is_publish' => true,
        'published_at' => now(),]);

         // ✅ Récupérer les utilisateurs de la même ville
         $users = User::where('ville_id', $programme->ville_id)->get();

         // ✅ Envoyer la notification à tous
         \Notification::send($users, new ProgrammePublishedNotification($programme));

         return redirect()->back()->with('success', 'Programme publié et notifications envoyées avec succès.');
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

        $programme = Programe::findOrFail($id);

        // Vérifie que le programme est bien dans la ville de l’utilisateur
        if ($programme->ville_id != $villeId) {
            abort(403, "Accès interdit à ce programme.");
        }

       // $communes = Commune::where('ville_id', $villeId)->get();
       // $selectedPharmacies = $programme->pharmacies->pluck('id')->toArray();
        // $pharmacies = Pharmacie::whereHas('commune', function($q) use ($villeId) {
        //     $q->where('ville_id', $villeId);
        // })->get();
        return view('programmes.edit', compact('programme'));
    }

    public function update(Request $request, Programe $programme)
    {
        // Validation
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'image_one' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        // Si un nouveau fichier est uploadé
        if ($request->hasFile('image_one')) {
            // Supprimer l'ancien fichier si existe
            if ($programme->image_one && Storage::disk('public')->exists($programme->image_one)) {
                Storage::disk('public')->delete($programme->image_one);
            }

            // Enregistrer le nouveau fichier
            $filePath = $request->file('image_one')->store('infosimages', 'public');
            $validated['image_one'] = $filePath;
        } else {
            // Si aucun nouveau fichier, garder l'ancien
            $validated['image_one'] = $programme->image_one;
        }

        // Mise à jour
        $programme->update([
            'name'       => $validated['name'],
            'image_one'  => $validated['image_one'],
            'user_id'    => auth()->id(),
            'ville_id'   => auth()->user()->ville_id,
        ]);

        return redirect()->route('programmes.index')
            ->with('success', 'Programme mis à jour avec succès.');
    }


   // app/Http/Controllers/ProgrameController.php
public function search(Request $request)
{
    $villeId = auth()->user()->ville_id;
   // $info = Info::where('ville_id', $villeId)->first();
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
    public function destroy($id)
    {
        $programme = Programe::findOrFail($id);
        $programme->delete();

        return redirect()->route('programmes.index')->with('success', 'Programme supprimée avec succès.');
    }
}

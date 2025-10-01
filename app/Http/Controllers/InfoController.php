<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;



class InfoController extends Controller
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
        $villeId = auth()->user()->ville_id;

        // Prendre seulement le premier enregistrement pour la ville
        $info = Info::where('ville_id', $villeId)->first();

        return view('apres.infos', compact('info'));
    }



    public function storeOrUpdate(Request $request)
    {
        $villeId = auth()->user()->ville_id;

        $validated = $request->validate([
            'name_Info' => 'required|string|max:255',
            'content_Info' => 'nullable|string',
            'tel_Info' => 'nullable|string|max:50',
            'adresse1_Info' => 'nullable|string|max:255',
            'adresse12_Info' => 'nullable|string|max:255',
            'image_one' => 'nullable|image|mimes:jpg,jpeg,png',
            'image_two' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Associer la ville
        $validated['ville_id'] = $villeId;

        // Vérifier si déjà existant
        $info = Info::where('ville_id', $villeId)->first();

        foreach (['image_one', 'image_two'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

                // 📂 Dossier de stockage
                $path = public_path('storage/infosimages');
                if (!file_exists($path)) {
                    mkdir($path, 0775, true);
                }

                // 🖼️ Traitement Intervention
                Image::make($file)
                    ->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($path . '/' . $filename);

                // Enregistrer le chemin relatif
                $validated[$field] = 'storage/infosimages/' . $filename;
            }
        }

        // Création ou mise à jour
        if ($info) {
            $info->update($validated);
        } else {
            $info = Info::create($validated);
        }

        return redirect()->route('apres.infos')
            ->with('success', 'Informations sauvegardées avec succès.');
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
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Info $info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        //
    }
}

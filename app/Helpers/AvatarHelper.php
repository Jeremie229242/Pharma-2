<?php

namespace App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class AvatarHelper
{
    public static function generate($name, $width = 200, $height = 200)
    {
        // Extraire les initiales (première lettre de chaque mot)
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        // Couleur de fond aléatoire (ou fixe)
        $colors = ['#1abc9c', '#3498db', '#9b59b6', '#e67e22', '#e74c3c', '#34495e','#25C9DA'];
        $bgColor = $colors[array_rand($colors)];

        // Créer l’image
        $img = Image::canvas($width, $height, $bgColor);

        // Ajouter les initiales
       // Dessiner un cercle plein au centre
$img->circle(
    min($width, $height),  // diamètre
    $width / 2,            // centre X
    $height / 2,           // centre Y
    function ($draw) use ($bgColor) {
        $draw->background($bgColor);
    }
);

// Ajouter les initiales
$img->text($initials, $width/2, $height/2, function($font) {
    $font->size(80);
    $font->color('#ffffff');
    $font->align('center');
    $font->valign('middle');
});

        if (!file_exists(public_path('avatars'))) {
            mkdir(public_path('avatars'), 0775, true);
        }
        // Sauvegarder dans storage/app/public/avatars
        $fileName = 'avatar_'.Str::random(10).'.png';
        $img->save(public_path('avatars/'.$fileName));

        return 'avatars/'.$fileName;
    }
}

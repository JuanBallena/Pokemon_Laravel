<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;

class ImageController extends Controller
{
    public static function saveImage($file)
    {
        $imagePath = $file->getRealPath();
        Cloudder::upload($imagePath, null, [
            'folder' => 'pokemons'
        ]);
        $publicId = Cloudder::getPublicId();
        $urlImage = Cloudder::show($publicId, [
            'width' => 400,
            'height' => 800,
        ]);
        return [
            "url_image" => $urlImage,
            "public_id_image" => $publicId
        ];
    }

    public static function deleteImage($publicId)
    {
        Cloudder::destroyImage($publicId, null);
        Cloudder::delete($publicId, null);
    }
}

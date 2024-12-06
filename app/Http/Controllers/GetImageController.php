<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class GetImageController extends Controller
{
    public function displayProfile($filename)
    {
        $path = storage_path('app/public/img_profiles', $filename);
        if (!File::exists) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }

    public function displayGuest($filename)
    {
        $path = storage_path('app/public/selfies', $filename);
        if (!File::exists) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }

    public function displayNews($filename)
    {
        $path = storage_path('app/public/thumbnails', $filename);
        if (!File::exists) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
}

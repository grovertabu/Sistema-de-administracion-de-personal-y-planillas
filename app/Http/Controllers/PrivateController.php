<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PrivateController extends Controller
{
    public function private_avatar($avatar)
    {
        $path = 'private/avatars/'.$avatar;
        if(!Storage::exists($path)){
            abort(404);
        }
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}

<?php

namespace App\Http\Controllers\Photo;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
Use DB;
use Illuminate\Http\Request;


class PhotoController extends Controller
{
    public function image($fileName){
        error_log($fileName);
        $path = public_path().'/uploads/images/'.$fileName;
        return Response::download($path);
    }
}

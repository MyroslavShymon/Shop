<?php

namespace App\Http\Services\File;

use Illuminate\Http\Request;
use Validator;

class FileService
{
    public function getFilePath(Request $req, string $filetype)
    {
        if (!$req->hasFile($filetype)) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $file = $req->file($filetype);

        if (!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $path = public_path() . '/uploads/' . $filetype . 's/';

        $file->move($path, $file->getClientOriginalName());
        return '/api/' . $filetype . '/' . $file->getClientOriginalName();
    }
}

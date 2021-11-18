<?php

namespace App\Http\Services\Validator;

use Illuminate\Http\Request;
use Validator;

class ValidatorService
{
    public function validate(Request $req, array $rules)
    {
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    }
}

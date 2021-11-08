<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function registration(Request $req)
    {
        $rules = [
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//        $fields = $req->validate([
//            'name'=>'required|string',
//            'email'=>'required|string',
//            'password'=>'required|string',
//        ]);

        $request = $req->all();
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request);

//        $token = $user->createToken('myapptoken')->plainTextToken;
//
//        $response = [
//          'user'=>$user,
//          'token'=> $token
//        ];

        return response()->json($user, 201);
    }

    public function login(Request $req)
    {

        $fields = $req->validate([
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

//        $token = $user->createToken('myapptoken')->plainTextToken;
//
//        $response = [
//          'user'=>$user,
//          'token'=> $token
//        ];

        return response()->json($user, 201);
    }
}

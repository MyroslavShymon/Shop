<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\Basket\BasketService;
use App\Http\Services\Role\RoleService;
use App\Http\Services\Validator\ValidatorService;
use App\Models\Basket;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use function MongoDB\BSON\fromJSON;

class UserController extends Controller
{
    private ValidatorService $validatorService;
    private BasketService $basketService;
    private RoleService $roleService;

    public function __construct(RoleService $roleService, ValidatorService $validatorService, BasketService $basketService)
    {
        $this->validatorService = $validatorService;
        $this->roleService = $roleService;
        $this->basketService = $basketService;
    }

    public function registration(Request $request)
    {
        $credentials = $request->only('email', 'password');
        //Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }


        //Request is valid, create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $userRole = Role::where('name', 'User')->first();

        UserRole::create([
            'role_id' => $userRole->id,
            'user_id' => $user->id
        ]);

        $user_roles = DB::table('user_roles')->
        where('user_id', $user->id)->
        leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')->
        select('roles.*')->
        get();

        $basket_id = DB::table('baskets')->where('user_id', $user->id)->first()->id;

        $this->basketService->createBasket($user->id);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => [
                'user' => $user,
                'role' => $user_roles
            ],
            'basket' => $basket_id,
            'token' => JWTAuth::attempt($credentials)
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Request is validated
        //Crean token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
//                $token = ;
//                error_log($t);
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }
        $user_roles = DB::table('user_roles')->
        where('user_id', auth()->user()->id)->
        leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')->
        select('roles.*')->
        get();

        $basket_id = DB::table('baskets')->where('user_id', auth()->user()->id)->first()->id;
        //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'message' => "Login success",
            'data' => [
                'user' => auth()->user(),
                'role' => $user_roles
            ],
            'basket' => $basket_id,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //try left join
    public function get_user(Request $request)
    {
        $users = User::leftJoin('baskets', function ($join) {
            $join->on('users.id', '=', 'baskets.user_id');
        })->get();
        return response()->json(['users' => $users]);
    }
}

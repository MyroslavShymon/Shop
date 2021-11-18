<?php

namespace App\Http\Services\Role;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

//use UserService;
//
use App\Http\Services\User\UserService;

class RoleService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createRole(Request $req): \Illuminate\Http\JsonResponse
    {
        return response()->json(Role::create($req->all()), 201);
    }

    public function getRoleById($id): \Illuminate\Http\JsonResponse
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        };
        return response()->json($role, 200);
    }

    public function getRoleByName($roleName)
    {
        $role = Role::where('name', $roleName)->first();
        if (is_null($role)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };

        return ['data' => $role, 'code' => 200];
    }

    public function applyRoleToUser($userId, $roleName)
    {
        ['data' => $role, 'code' => $code] = $this->getRoleByName($roleName);

        if ($role['error'])
            return response()->json($role, $code);

        ['data' => $user, 'code' => $code] = $this->userService->getUserById($userId);

        if ($user['error'])
            return response()->json($role, $code);

        $user_role = UserRole::create([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);
        return response()->json($user_role, 200);
    }
}

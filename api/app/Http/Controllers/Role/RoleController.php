<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Services\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->roleService->createRole($request);
    }

    public function getById($id): \Illuminate\Http\JsonResponse
    {
        return $this->roleService->getRoleById($id);
    }

    public function applyToUser($userId, Request $request)
    {
        ['roleName' => $roleName] = $request;
        return $this->roleService->applyRoleToUser($userId, $roleName);
    }

}

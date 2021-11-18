<?php

namespace App\Http\Services\User;

use App\Models\User;

class UserService
{
    public function getUserById($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };

        return ['data' => $user, 'code' => 200];
    }
}

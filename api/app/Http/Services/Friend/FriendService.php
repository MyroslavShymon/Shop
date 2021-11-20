<?php

namespace App\Http\Services\Friend;

use App\Http\Services\User\UserService;
use App\Models\Friend;
use Illuminate\Http\Request;

class FriendService
{
    private UserService $userService;


    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function addFriend(Request $request): \Illuminate\Http\JsonResponse
    {
        $req = $request->all();
        ['data' => $user1, 'code' => $code] = $this->userService->getUserById($req['user_id_1']);
        if ($user1['error'])
            return response()->json($user1, $code);

        ['data' => $user2, 'code' => $code] = $this->userService->getUserById($req['user_id_2']);
        if ($user2['error'])
            return response()->json($user2, $code);

        return response()->json(Friend::create($req), 201);
    }

    public function removeFriend(Request $request)
    {
        $req = $request->all();
        $friend = Friend::
        where('user_id_1', $req['user_id_1'])->
        where('user_id_2', $req['user_id_2'])->
        first();

        if ($friend) {
            $friend->delete();
            return response()->json('Friend was delete success', 200);
        }
        return response()->json('There is no friend with this id', 200);
    }

    public function getFriends($id): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            Friend::
            where('user_id_1', $id)->get(),
            200);
    }
}

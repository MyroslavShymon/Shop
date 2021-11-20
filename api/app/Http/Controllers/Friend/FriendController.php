<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\Controller;
use App\Http\Services\Friend\FriendService;
use App\Http\Services\User\UserService;
use App\Http\Services\Validator\ValidatorService;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    private ValidatorService $validatorService;
    private FriendService $friendService;

    public function __construct(ValidatorService $validatorService, FriendService $friendService)
    {
        $this->friendService = $friendService;
        $this->validatorService = $validatorService;
    }

    public function add(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'user_id_1' => 'required|numeric',
            'user_id_2' => 'required|numeric',
        ])) return $errors;

        return $this->friendService->addFriend($request);
    }

    public function remove(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'user_id_1' => 'required|numeric',
            'user_id_2' => 'required|numeric',
        ])) return $errors;

        return $this->friendService->removeFriend($request);
    }

    public function getFriends($id): \Illuminate\Http\JsonResponse
    {
        return $this->friendService->getFriends($id);
    }
}

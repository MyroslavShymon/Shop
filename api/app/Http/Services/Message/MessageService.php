<?php

namespace App\Http\Services\Message;

use App\Http\Services\User\UserService;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function send(Request $request): \Illuminate\Http\JsonResponse
    {
        $req = $request->all();

        ['data' => $from_user, 'code' => $code] = $this->userService->getUserById($req['from_user_id']);
        if ($from_user['error'])
            return response()->json($from_user, $code);
        ['data' => $to_user, 'code' => $code] = $this->userService->getUserById($req['to_user_id']);
        if ($to_user['error'])
            return response()->json($to_user, $code);

        return response()->json(Message::create($req), 201);
    }

    public function delete($id)
    {
        $message = Message::find($id);
        if (is_null($message)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        };
        $message->delete();
        return response()->json('Message was deleted success', 200);
    }
}

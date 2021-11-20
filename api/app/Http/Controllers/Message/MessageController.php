<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Validator\ValidatorService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private ValidatorService $validatorService;
    private MessageService $messageService;

    public function __construct(ValidatorService $validatorService, MessageService $messageService)
    {
        $this->messageService = $messageService;
        $this->validatorService = $validatorService;
    }

    public function send(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'text' => 'required',
            'from_user_id' => 'required|numeric',
            'to_user_id' => 'required|numeric',
        ])) return $errors;
        return $this->messageService->send($request);
    }

    public function delete($id)
    {
        return $this->messageService->delete($id);
    }
}

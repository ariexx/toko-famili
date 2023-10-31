<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->uuid;
        $allChat = Chat::whereUserUuid($userId)->get();
        return view('user.chat.index', compact('allChat'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        //show all chat from user
        $allChat = Chat::whereUserUuid($id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $allChat
        ]);
    }

    public function send(Request $request)
    {
        $userId = auth()->user()->uuid;
        $chat = Chat::create([
            'user_uuid' => $userId,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $chat
        ]);
    }

    public function getMessages(): string
    {
        $userId = auth()->user()->uuid;
        $allChat = Chat::whereUserUuid($userId)->get();
        //return html
        $html = '';
        foreach ($allChat as $chat) {
            $html .= '<div class="chat-message-right mb-4">';
            $html .= '<div>'; #start div for image and time
            $html .= '<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">';
            $html .= '<div class="text-muted small text-nowrap mt-2">' . $chat->created_at .' </div>';
            $html .= '</div>'; #end div for image and time
            $html .= '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">';
            $html .= '<div class="font-weight-bold mb-1">You</div>';
            $html .= $chat->message;
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }
}

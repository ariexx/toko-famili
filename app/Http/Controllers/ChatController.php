<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->uuid;
        $admin = User::where('level', 'admin')->first();
        $adminUuid = $admin->uuid;

        $allChat = Chat::where('from_user_uuid', $userId)->orWhere('from_user_uuid', $adminUuid)
            ->with(["fromUser", "toUser"])->orderBy('created_at', 'asc')->get();
        return view('user.chat.index', compact('allChat', 'adminUuid'));
    }

    public function chatWithUserFromAdmin($userUuid, Request $request)
    {
        //send chat from admin to user
        $admin = User::where('level', 'admin')->first();
        $chat = Chat::create([
            'from_user_uuid' => $admin->uuid,
            'to_user_uuid' => $userUuid,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $chat
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function getLastChatFromAdmin()
    {
        $userId = auth()->user()->uuid;
        $admin = User::where('level', 'admin')->first();
        $lastChat = Chat::whereFromUserUuid($admin->uuid)->whereToUserUuid($userId)->orderBy('created_at', 'desc')->first();
        return response()->json([
            'status' => 'success',
            'data' => $lastChat
        ]);
    }

    public function send(Request $request)
    {
        $userId = auth()->user()->uuid;
        //get first admin role
        $admin = User::where('level', 'admin')->first();
        $chat = Chat::create([
            'from_user_uuid' => $userId,
            'to_user_uuid' => $admin->uuid,
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

    //for admin
    public function getLastChatByUserUuid($userUuid)
    {
        $userId = auth()->user()->uuid;
        $lastChat = Chat::whereFromUserUuid($userUuid)->whereToUserUuid($userId)->latest()->first();
        return response()->json([
            'status' => 'success',
            'data' => $lastChat
        ]);
    }

    public function showChatByUserUuid($userUuid)
    {
        $userId = auth()->user()->uuid;
        $allChat = Chat::where('from_user_uuid', $userId)
            ->orWhere('from_user_uuid', $userUuid)
            ->with(["fromUser", "toUser"])
            ->orderBy('created_at', 'asc')
            ->get();

        //get message from userUuid to admin
        $allChatToAdmin = Chat::whereFromUserUuid($userUuid)->get();
        //merge all chat
        $allChat = $allChat->merge($allChatToAdmin);
        //get admin chat with all users
        $allChatWithAdmin = Chat::whereToUserUuid($userId)->with(["fromUser", "toUser"])->orderBy('created_at', 'asc')->get()->unique('from_user_uuid');
        $getUserName = User::whereUuid($userUuid)->first()->name;

        return view('admin.chat.index', compact(['allChat', 'userUuid', 'allChatWithAdmin', 'getUserName']));
    }

    public function adminSendMessage(Request $request)
    {
        $userId = auth()->user()->uuid;
        $chat = Chat::create([
            'from_user_uuid' => $userId,
            'to_user_uuid' => $request->user_uuid,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $chat
        ]);
    }
}

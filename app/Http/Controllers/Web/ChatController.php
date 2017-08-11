<?php

namespace App\Http\Controllers\Web;

use App\Events\Chat;
use App\Models\ChatMessageModel;
use App\Models\ChatModel;
use App\Models\ChatUserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(){
        $usersList = User::where('id', '!=', Auth::user()->id)->get();
        return view('pages.chat.users-list', compact('usersList'));
    }

    public function private_chat($id){
        $userData   = User::find($id);
        $chatId     = ChatUserModel::checkPrivateChatMember(Auth::user()->id, $id);
        $conversationData = null;
        if($chatId !== false){
            $conversationData = ChatMessageModel::where('chat_id', $chatId)->get();
        }
        return view('pages.chat.conversation', compact('userData', 'chatId', 'conversationData'));
    }

    public function send(Request $request){
        if($request->input('chat_type') == ChatModel::PRIVATE){
            $checkMember    = ChatUserModel::checkPrivateChatMember($request->input('from'), $request->input('to'));
            if($checkMember === false){
                $chat_id = $this->register_private_chat($request);
            } else {
                $chat_id = $checkMember;
            }
        }
        $message    = new ChatMessageModel();
        $message->chat_id   = $chat_id;
        $message->user_id       = $request->input('from');
        $message->message       = $request->input('message');
        $message->message_type  = ChatMessageModel::TEXT;       //Only accept text message
        $message->save();

        $user = User::find($request->input('to'));
        $data = [
            'chat_id'   => $chat_id,
            'message_id'=> $message->id,
            'message'   => $request->input('message'),
            'type'      => ChatMessageModel::TEXT,
            'from'      => $request->input('from'),
            'to'        => $request->input('to')
        ];
        broadcast(new Chat($user, $data));
        return $this->responseJson($data);
    }

    private function register_private_chat($request){
        $chat_id = ChatUserModel::checkPrivateChatMember($request->input('from'), $request->input('to'));
        if($chat_id === false){
            $chat       = new ChatModel();
            $chat->chat_type = ChatModel::PRIVATE;
            $chat->is_active = 1;
            $chat->save();

            $chat_id = $chat->id;
            for($i = 0; $i < 2; $i++){
                $chat_user = new ChatUserModel();
                $chat_user->chat_id   = $chat_id;
                $chat_user->user_id   = ($i % 2 == 0 ? $request->input('from') : $request->input('to'));
                $chat_user->save();
            }
        }
        return $chat_id;
    }

    private function responseJson($data, $statusCode = 200) {
        return response()->json($data, $statusCode);
    }
}

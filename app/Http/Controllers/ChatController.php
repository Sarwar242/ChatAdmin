<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\Admin;
use App\Events\MessageSent;
use App\Events\MessageToAdmin;
use Illuminate\Http\Request;
use Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'msg' => 'required',
        ]);
        $message= new Message;
        $conv = Conversation::where('user_one',Auth::id())->first();
        if(!is_null($conv)){
            $conv->updated_at=now();
            $message->conversation_id=$conv->id;
            $conv->save();
        }
        else{
            $conversation = new Conversation;
            $conversation->user_one=Auth::id();
            $conversation->user_two =1;
            $conversation->status = 1;
            $conversation->save();
            $message->conversation_id=$conversation->id;
        }
        $message->user_id=Auth::id();
        if ($request->hasFile('file')) {
            $message->file=$request->file;
        }
        $admin = Admin::find(1);
        $message->message =$request->msg;
        $message->by_user =1;
        $message->save();
        // $user = Auth::user();
        broadcast(new MessageToAdmin($admin,$message))->toOthers();

        return json_encode([
            'status' => 'success',
            'message' => 'Sent'
        ]);
    }



    public function storeAdmin(Request $request)
    {
        $this->validate($request, [
            'msg' => 'required',
            'user_id' => 'required',
        ]);
        $message= new Message;
        $conv = Conversation::where('user_one',$request->user_id)->first();
        if(!is_null($conv)){
            $conv->updated_at=now();
            $message->conversation_id=$conv->id;
            $conv->save();
        }
        else{
            $conversation = new Conversation;
            $conversation->user_one=$request->user_id;
            $conversation->user_two = Auth('admin')->id();
            $conversation->status = 1;
            $conversation->save();
            $message->conversation_id=$conversation->id;
        }
        $message->user_id=$request->user_id;
        if ($request->hasFile('file')) {
            $message->file=$request->file;
        }

        $message->message =$request->msg;
        $message->save();
        $user = User::find($request->user_id);
        broadcast(new MessageSent($user, $message))->toOthers();
        return json_encode([
            'status' => 'success',
            'message' => 'Sent'
        ]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {

        $users=Conversation::orderby('updated_at', 'desc')->get()->unique('user_one');
        foreach($users as $chats)
        {
            $name=$chats->user->name;
        }

        return json_encode($users);
    }


    public function destroy(Chat $chat)
    {
        //
    }
}

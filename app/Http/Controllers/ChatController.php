<?php

namespace App\Http\Controllers;

use App\Chat;
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
        $chat= new Chat;
        $chat->user_id=Auth::id();
        $chat->is_sent = 1;
        $chat->is_userseen =1;
        $chat->message =$request->msg;
        $chat->save();

        return json_encode(['status' => 'success',
            'message' => 'Sent']);
    }

    
   
    public function storeAdmin(Request $request)
    {
        $this->validate($request, [
            'msg' => 'required',
            'user_id' => 'required',
        ]);
        $chat= new Chat;
        $chat->user_id=$request->user_id;
        $chat->is_sent = 0;
        $chat->is_userseen =0;
        $chat->is_adminseen =1;
        $chat->message =$request->msg;
        $chat->save();

        return json_encode(['status' => 'success',
            'message' => 'Sent']);
    }

    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        
        $users=Chat::orderby('created_at', 'desc')->get()->unique('user_id');
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

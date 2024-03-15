<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageApiController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();
        $lists = Message::list($query);
        return $lists;
    }
    public function store(Request $request)
    {
        $Message =new Message;
        $Message->memberId = 1;
        $Message->comment = $request->comment;
        $Message->save();
        $Message_id = $Message->commentNo;

        return response()->json(["message" => "新增成功", "id" => $Message_id], 201);
    }

    public function edit($commentNo)
    {
        $message = Message::showEditMsg($commentNo);
        return $message;
    }

    public function show($commentNo)
    {
        $message = Message::showEditMsg($commentNo);
        return $message;
    }
    
    public function update(Request $request,  $commentNo)
    {
        $message = Message::find($commentNo);
        $message->comment = $request->comment;
        $message->update();
        return response()->json(["message" => "修改成功"], 201);
    }

    public function destroy($commentNo)
    {
        $message = Message::find($commentNo);
        $message->delete();
        return response()->json(["message" => "刪除成功"], 201);
    }
}

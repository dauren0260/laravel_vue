<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();
        $lists = Message::list($query);
        return view("message/index");
    }

    public function edit($commentNo)
    {
        return view("message/edit");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Message extends Model
{
    use HasFactory;
    protected $table = "message";
    protected $primaryKey = "commentNo";

    protected $fillable = [];
    
    public static function list($query){        
        $messageList = DB::table("message as g")
        ->select("m.id","m.memName","m.memAvatar","g.commentNo","g.comment","g.updated_at")
        ->join("member as m", "g.memberId","=","m.id");

        if( isset($query["author"]) && ($query["author"] != "") )
        {
            $messageList->where("m.memName","like","%{$query['author']}%");
        }
        if( isset($query["content"]) && ($query["content"] != "") )
        {
            $messageList->where("g.comment","like","%{$query['content']}%");
        }
        if( isset($query["startDate"]) && ($query["startDate"] != "") )
        {
            $messageList->whereDate("g.updated_at",">=","{$query['startDate']}");
        }
        if( isset($query["endDate"]) && ($query["endDate"] != "") )
        {
            $messageList->whereDate("g.updated_at","<=","{$query['endDate']}");
        }

        $list = $messageList->orderBy("g.updated_at","desc")->get();
   
        return $list;
    }
    public static function showEditMsg($commentNo)
    {
        $message = DB::table("message as g")
        ->select("m.id","m.memName","m.memAvatar","g.commentNo","g.comment","g.updated_at")
        ->join("member as m", "g.memberId","=","m.id")
        ->where("g.commentNo","=", $commentNo)
        ->first();

        return $message;
    }

}

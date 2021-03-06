<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use App\Models\Content;
use App\Models\Respond;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class GuestbookController extends Controller
{
    public function create(Request $request) {
        if (Auth::check()){
            $member = Auth::user();
            $account = $member -> account;
            $validator = Validator::make($request->all(),[
                'article' => 'required|string|max:255|min:2',
                'detail' => 'required|string|max:255',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
            $time = now();  
            $guestbook = Guestbook::create(array_merge([
                'owner' => $account,
                'name' => $member -> name,
                'article' => $request->article,
                'created_at' => $time,
                'updated_at' => $time,
                'last_content_time' => $time,
            ]));
            $guestId = $guestbook-> id;
            $content = Content::create(array_merge([
                'guest_id' => $guestbook-> id,
                'detail_account' => $account,
                'name' => $member -> name,
                'detail' => $request->detail,
                'floor' => 1,
            ]));

            return response()->json(['message' => '成功發表文章']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function get_all(){
            return Guestbook::orderBy('last_content_time','desc')->get();
    }
    public function get_id($id){
        $guestbook = Guestbook::where('id',$id)->get();
        $guestbook = $guestbook[0];
        $first_floor = Content::where('guest_id',$id)->where("floor",1)->get()[0];
        $guestbook["content_id"] = $first_floor->id;
        return $guestbook;
    }
    public function edit(Request $request) {
        if(Auth::check()){
            $member = Auth::user();
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'article' => 'required|string|max:255|min:2',
                'content' => 'required|string|max:255',
            ]);

            $time = now();  
            $guestbook =Guestbook::where('id', $request -> id)->update(
                ['article' => $request->article,
                'updated_at' => $time,]
            );
            $guestbook =Content::where('guest_id', $request -> id)->where("floor",1)->update(
                ['detail' => $request->content]
            );
            return response()->json(['message' =>$guestbook]);
        }
    }
    public function delete(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
            ]);
            $respond = Guestbook::findOrFail($request -> id);
            $respond -> delete();
            return response()->json(['message' =>"刪除成功"]);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
}

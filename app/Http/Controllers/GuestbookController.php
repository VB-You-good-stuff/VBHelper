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
                'last_content_time' => $time,
            ]));
            $guestId = $guestbook-> id;
            $content = Content::create(array_merge([
                'guest_id' => $guestbook-> id,
                'detail_account' => $account,
                'name' => $member -> name,
                'detail' => $request->detail,
                'floor' => 1,
                'created_at' => $time,
            ]));

            return response()->json(['message' => '成功了你好會發文哦']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function get_all(){
        if(Auth::check()){
            return Guestbook::orderBy('last_content_time','desc')->get();
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function Edit(Request $request) {
        if(Auth::check()){
            $member = Auth::user();
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'article' => 'required|string|max:255|min:2'
            ]);
            $guestbook = Guestbook::findOrFail($request -> id);
            $guestbook -> article = $request -> article;
            $time = now();
            $guestbook -> updated_at = $time;
            $guestbook->save();
            return response()->json(['message' => $guestbook]);
        }
    }
    public function delete(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
            ]);
            
            Guestbook::find($request -> id);
            $content = Content::where('guest_id',$request->id)->get();
            return $content;
            // $respond = Respond::where('content_id',$content->id)->get();
            // return $respond;
            //return response()->json(['message' => '刪除成功']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
}

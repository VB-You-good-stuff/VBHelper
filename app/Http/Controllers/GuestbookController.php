<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use App\Models\Content;
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
                'article' => 'required|string',
                'detail' => 'required|string|max:255',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
            $guestbook = Guestbook::create(array_merge([
                'owner' => $account,
                'article' => $request->article
            ]));
            $guestId = $guestbook-> id;
            

            $content = Content::create(array_merge([
                'guest_id' => $guestbook-> id,
                'detail_name' => $account,
                'detail' => $request->detail,
                'floor' => 1,
            ]));

            return response()->json(['message' => '成功了你好會發文哦']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function get_all(){
        if(Auth::check()){
            return Guestbook::all();
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function Edit(Request $request) {
        if(Auth::check()){
            $member = Auth::user();
            $validator = Validator::make($request->all(),[
                ''
            ]);
        }
    }
    public function delete(Request $request){
        if(Auth::check()){

            Guestbook::find($request -> id)->delete();

            return response()->json(['message' => '刪除成功']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
}

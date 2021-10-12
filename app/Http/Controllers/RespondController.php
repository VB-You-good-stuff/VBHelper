<?php

namespace App\Http\Controllers;

use App\Models\Respond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RespondController extends Controller
{
    public function create(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'content_id' => 'required',
                'reply' => 'required|string|max:255|min:2',
            ]);
            Respond::create(array_merge([
                'content_id' => $request->content_id,
                'reply_account' => Auth::user()->account,
                'name' => Auth::user()->name,
                'reply' => $request->reply
            ]));
            return response()->json(['message' => '成功了你好會回覆哦']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function get_all(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
            ]);
            return Respond::where('content_id',$request->id)->get();
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function edit(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'reply' => 'required|string|max:255|min:2'
            ]);
            $respond = Respond::findOrFail($request -> id);
            $respond -> reply = $request -> reply;
            $respond->save();
            return response()->json(['message' => $respond]);
            
        }
    }
}

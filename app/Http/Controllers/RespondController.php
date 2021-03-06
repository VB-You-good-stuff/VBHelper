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
                'reply' => $request->reply,
            ]));
            return response()->json(['message' => '成功留言']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function get_all(Request $request){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
            ]);
            return Respond::where('content_id',$request->id)->get();
    }
    public function edit(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'reply' => 'required|string|max:255|min:2'
            ]);
            $respond = Respond::findOrFail($request -> id);
            $respond -> reply = $request -> reply;
            $respond -> updated_at = now();
            $respond->save();
            return response()->json(['message' => $respond]);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function delete(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
            ]);
            $respond = Respond::findOrFail($request -> id);
            $respond -> delete();
            return response()->json(['message' =>"刪除成功"]);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
}

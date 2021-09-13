<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class ContentController extends Controller
{
    public function create(Request $request){
        //傳文章的ID跟要新增的內容給我
        if(Auth::check()){
            $member = Auth::user();
            $account = $member -> account;
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'detail' => 'required|string|max:255',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
            $floor = Content::where('guest_id', $request->id)->count();

            $content = Content::create(array_merge([
                'guest_id' => $request->id,
                'detail_name' => $account,
                'detail' => $request->detail,
                'floor' => $floor+1,
            ]));

            return response()->json(['message' => '成功了你好會留言哦']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function get_all(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
            ]);
            return Content::where('guest_id',$request->id)->get();
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function edit(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'detail' => 'required|string|max:255|min:2'
            ]);
            $content = Content::findOrFail($request -> id);
            $content -> detail = $request -> detail;
            $content->save();
            return response()->json(['message' => $content]); 
        }
    }
}


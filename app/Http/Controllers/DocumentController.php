<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create(Request $request) {
        if (Auth::check()){
            $member = Auth::user();
            $account = $member -> account;
            $validator = Validator::make($request->all(),[
                'title' => 'required|string|max:255|min:2',
                'document' => 'required|string|max:255',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
            $document = Document::create($validator);
            return response()->json(['message' => '成功了']);
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
    public function get_all(){
        if(Auth::check()){
            return Document::all();
        }
        return response()->json(['message' => '為甚麼不登入?']);
    }
}

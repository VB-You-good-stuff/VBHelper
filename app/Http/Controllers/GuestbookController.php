<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class GuestbookController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function Create(Request $request) {
        if (Auth::check()){
            $member = Auth::user();
            $account = $member -> account;
            $validator = Validator::make($request->all(),[
                'article' => 'required|string',
                'detail' => 'required|string',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
            $guestbook = Guestbook::create(array_merge([
                'owner' => $account,
                'article' => $request->article
            ]));
            $guestId = $guestbook-> id;
            $floor = Content::where('guest_id', '=', $guestId)->get();

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
}

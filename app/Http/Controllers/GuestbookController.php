<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestbookController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function Create(Request $request) {
        $member = Auth::user();
        $account = $member -> account;
        if (Auth::check()){
            $validator = Validator::make($request->all(),[
                'article' => 'required|string',
                'detail' => 'required|string',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
            return $validator;
        }
        return response()->json(['message' => '給我滾去登入啦北七']);;
    }
}

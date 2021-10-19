<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Member;

use Validator;

class MembersController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request) {

        $validator = Validator::make($request->all(),[
            'account' => 'required|string|min:8|max:30|unique:members,account',
            'password' => 'required|string|min:8|max:30',
            'name' => 'required|string|min:1|max:10',
            'email' => 'required|email|unique:members,email',
        ],[
            'account.unique' => '該帳號已註冊過。',
            'account.required' => '請輸入帳號。',
            'account.min' => '帳號至少:min個字。',
            'account.max' => '帳號最多:max個字。',
            'password.required' => '請輸入密碼。',
            'password.min' => '密碼至少:min個字。',
            'password.max' => '密碼最多:max個字。',
            'name.required' => '請輸入名字。',
            'name.min' => '名字至少:min個字。',
            'name.max' => '名字最多:max個字。',
            'email.required' => '請輸入email。',
            'email.unique' => '該email已註冊過。',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $member = Member::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => '註冊成功囉',
            'member' => $member
        ],201) ;
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'account' => 'required|string|min:8|max:30',
            'password' => 'required|string|min:8|max:30',
        ],[
            'account.required' => '請輸入帳號。',
            'password.required' => '請輸入密碼。',
            'account.min' => '帳號至少:min個字。',
            'password.min' => '密碼至少:min個字。',
            'account.max' => '帳號最多:max個字。',
            'password.max' => '密碼最多:max個字。',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())){
            return response()->json(['error' => '帳號或密碼錯了，請重新輸入!'], 401);
        }

        return $this->createNewToken($token);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => '終於離開囉?']);
    }

    public function getaccount(){
        if(Auth::check()){
            return response()->json([
                'account' => auth()->user()->account,
                'name' => auth()->user()->name
            ]);
        }
        return response()->json([
            'message' => '你登入就過期了啊'
        ]);
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}

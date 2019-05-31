<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    /*
     * 登录
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string|confirmed'
            ]);
            $credentials = request(['username', 'password']);

            if (!Auth::attempt($credentials))
                return $this->setStatusCode(401)->failed(['message' => 'Unauthorized']);

            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access token1');
            $token = $tokenResult->token;

            if ($request->get('remember_me'))
                $token->expires_at = Carbon::now()->addDays(1);

            $token->save();

            return $this->setStatusCode(201)->message([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateString()
            ]);
        } catch (\Exception $e) {
            return $this->setStatusCode(401)->failed([
                'message' => $e->getMessage()
            ]);
        }
    }
    /*
     * 退出
     */
    public function logout(Request $request)
    {
        return [$request->user()->token()->revoke()];
    }
    /*
     * 从新获取token
     */
    public function refresh(Request $request)
    {
        return 'refresh';
    }
    /*
     * 获取用户信息
     */
    public function user(Request $request)
    {
        return $this->setStatusCode(200)->message([
            'message' => $request->user(),
            'status' => 200
        ]);
    }
    public function username()
    {
        return 'username';
    }
}

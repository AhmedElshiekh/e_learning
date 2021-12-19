<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\EmailVerifyTrait;
use App\Http\Traits\TwilioTrait;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    use ApiResponseTrait;
    use EmailVerifyTrait;
    // use TwilioTrait;

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->sid          = config('twilio.account_sid');
        $this->token        = config('twilio.auth_token');
        $this->messaging    = config('twilio.messaging_sid');
    }


    /**
     * Register new user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'      => 'required',
            'type'      => 'required',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required|unique:users',
            'password'  => 'required|min:4|confirmed',
        ]);
        if ($validate->fails()) :
            return $this->apiResponse(null, 422, $validate->errors());
        endif;

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        $user->save();

        if($user):
            // $this->SendVerifyToken($request->phone, $user->id);
            $this->SendVerifyToken($request->email, $user->id);

            // $credentials = ['phone' => $request->get('phone'), 'password'=>$request->get('password')];
            // $token = Auth::attempt($credentials);

            $data = [
                'key'           => $user->id,
                // 'access_token'  => $token,
                // 'token_type'    => 'bearer',
                // 'expires_in'    => auth::factory()->getTTL() * 60,
                'type'          => $user->type,
                'verified'      => $user->verified,
                'name'          => $user->name,
            ];

            return $this->apiResponse($data, 200, 'success to create account ,should verify phone');
        endif;

        return $this->apiResponse(null, 404, 'register filed');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // $credentials = request(['email', 'password']);
        $validate = Validator::make($request->all(), [
            'email'         => 'required_without:phone|email|max:255',
            'phone'         => 'required_without:email|min:9',
            'password'      => 'required|max:25|min:6',
        ]);
        if ($validate->fails()) :
            return $this->apiResponse(null, 422, $validate->errors());
        endif;


        if($request->input('email')){
            $credentials = ['email'=>$request->get('email'),'password'=>$request->get('password')];
            $email = $request->input('email');
            $user = User::where('email', $request->input('email'))->first();
        }
        elseif ($request->input('phone')) {
            $credentials = ['phone' => $request->get('phone'), 'password'=>$request->get('password')];
            $user = User::where('phone', $request->input('phone'))->first();
            $email = $user->email;
        }

        if($user && $user->verified == false):
            $data = ['user_key' => $user->id];
            return $this->apiResponse($data, 403, 'You should verify you phone');
        endif;


        // dd($credentials);
        if (!$token = Auth::attempt($credentials)) {

            return $this->apiResponse(null, 401, 'The password or email is failed');
        }

        // $email = auth
        return $this->respondWithToken($token, $email);
    }



    public function verification(Request $request, $uid)
    {
        $validate = Validator::make($request->all(), [
            'code'   => 'required|numeric|digits:6',
        ]);

        if ($validate->fails()) :
            return $this->apiResponse(null, 422, $validate->errors());
        endif;

        $user = User::find($uid);
        $check = $this->CheckVerifyToken($user->email, $request->code);

        if($check):
            $user->verified = true;
            $user->verify_msg->delete();
            $user->save();

            $token = Auth::fromUser($user);
            $data = [
                'key'           => $user->id,
                'access_token'  => $token,
                'token_type'    => 'bearer',
                'expires_in'    => auth::factory()->getTTL() * 60,
                'type'          => $user->type,
                'verified'      => $user->verified,
                'name'          => $user->name,
            ];

            return $this->apiResponse($data, 200, 'Thanks for verify your phone');
        endif;

        return $this->apiResponse(null, 401, 'The verify failed');
    }



    public function resendVerifyCode($uid)
    {
        $send = $this->ResendVerifyToken($uid);

        if($send == true):
            return $this->apiResponse(null, 200);
        endif;

        return $this->apiResponse(null, 401, 'send code failed');
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (Auth::check()) :
            Auth::logout();
            return $this->apiResponse(null, 200, 'Successfully logged out');
        endif;

        // if all failed return error 520
        return $this->apiResponse(null, 520, 'Un Know Error');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authCheck()
    {
        if (Auth::check()) :
            $data = [ 'token_work'    =>  true];
            return $this->apiResponse($data, 200, 'You are login');
        endif;

        $data = [ 'token_work'    =>  false ];
        // if all failed return error 520
        return $this->apiResponse($data, 200, 'please, login');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $email)
    {
        $user = User::where('email', $email)->first();
        // dd($user);
        $data = [
            'key'           => $user->id,
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth::factory()->getTTL() * 60,
            'type'          => $user->type,
            'name'          => $user->name,
        ];

        return $this->apiResponse($data, 200);
    }
}

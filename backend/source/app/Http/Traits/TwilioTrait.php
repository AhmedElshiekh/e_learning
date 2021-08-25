<?php

namespace App\Http\Traits;

use App\Models\UserVerified;
use App\User;
use Twilio\Rest\Client;

trait TwilioTrait
{
    public $sid;
    public $token;
    public $messaging;

    public function __construct()
    {
        $this->sid                    = config('twilio.account_sid');
        $this->token                  = config('twilio.auth_token');
        $this->messaging              = config('twilio.messaging_sid');
    }


    public function SendRequestClass($number)
    {
        $client = new Client($this->sid, $this->token);


        $msg = $client->messages->create(
            $number,
            array(
                "messagingServiceSid" =>  $this->messaging,
                'body' => 'لقد تلقينا طلبك وسيتم التواصل معكم في اقرب وقت'
            )
        );

        return $msg;
    }



    public function SendVerifyToken($number, $uid)
    {
        $client = new Client($this->sid, $this->token);
        $code = random_int(100000, 999999);

        $msg = $client->messages->create(
            $number,
            array(
                "messagingServiceSid" =>  $this->messaging,
                'body' => 'كود التفعيل الخاص بكم  : ' . $code
            )
        );

        // if ($msg->status == 'accepted') :
            $saveData = UserVerified::create([
                'user_id'       => $uid,
                'phone'         => $number,
                'code'          => $code,
            ]);
        // endif;
        return $saveData;
    }




    public function CheckVerifyToken($number, $code)
    {
        $userVerify = UserVerified::where('phone', $number)->latest()->first();

        if ($userVerify) :
            $verify = $userVerify->code == $code ? true : false;
            if ($verify == true) return true;
        endif;

        return false;
    }



    public function ResendVerifyToken($uid)
    {
        $client = new Client($this->sid, $this->token);
        $user = User::find($uid);
        // dd($user->verify_msg);

        $code = random_int(100000, 999999);
        $msg = $client->messages->create(
            $user->phone,
            array(
                "messagingServiceSid" =>  $this->messaging,
                'body' => 'Your code to active account : ' . $code
            )
        );

        $userVerify = $user ? $user->verify_msg : null;

        // if ($msg->status == 'accepted') :
            $userVerify ? $userVerify->update(['code' => $code])
                : UserVerified::create([
                    'user_id'   => $uid,
                    'phone'     => $user->phone,
                    'code'      => $code,
                ]);

            // return true;
        // endif;

        return false;
    }
}

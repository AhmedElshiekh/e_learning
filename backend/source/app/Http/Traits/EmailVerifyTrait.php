<?php

namespace App\Http\Traits;

use App\Mail\VerifyMail;
use App\Models\UserVerified;
use App\User;
use Illuminate\Support\Facades\Mail;

trait EmailVerifyTrait
{

    public function SendRequestClass($email)
    {
        // $client = new Client($this->sid, $this->token);


        // $msg = $client->messages->create(
        //     $email,
        //     array(
        //         "messagingServiceSid" =>  $this->messaging,
        //         'body' => 'لقد تلقينا طلبك وسيتم التواصل معكم في اقرب وقت'
        //     )
        // );

        // return $msg;
    }



    public function SendVerifyToken($email, $uid)
    {
        $code = random_int(100000, 999999);

        Mail::to($email)->send(new VerifyMail($code));

        $saveData = UserVerified::create([
            'user_id'       => $uid,
            'email'         => $email,
            'code'          => $code,
        ]);

        return $saveData;
    }




    public function CheckVerifyToken($email, $code)
    {
        $userVerify = UserVerified::where('email', $email)->latest()->first();

        if ($userVerify) :
            $verify = $userVerify->code == $code ? true : false;
            if ($verify == true) return true;
        endif;

        return false;
    }



    public function ResendVerifyToken($uid)
    {

        $user = User::find($uid);
        // dd($user->verify_msg);

        if ($user) :
            $code = random_int(100000, 999999);

            Mail::to($user->email)->send(new VerifyMail($code));

            $user->verify_msg ? $user->verify_msg->update(['code' => $code])
                : UserVerified::create([
                    'user_id'   => $uid,
                    'email'     => $user->email,
                    'code'      => $code,
                ]);

            return true;
        endif;

        return false;
    }
}

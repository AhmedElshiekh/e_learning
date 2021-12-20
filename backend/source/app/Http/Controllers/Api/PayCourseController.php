<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\PayMobTrait;
use App\Models\Chapter;
use App\Models\Classes;
use App\Models\ClassLesson;
use App\Models\Lesson;
use App\Models\Voucher;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayCourseController extends Controller
{
    use PayMobTrait;
    use ApiResponseTrait;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment($id)
    {
        // dd($id);
        $user = Auth::user();
        $course = Course::find($id);
        $discount = $course->discountPrice != 0 ? $course->discountPrice : null;
        $price = $this->convertCurrency($discount ?? $course->price);

        $order = new Order;
        $order->course_id = $id;
        $order->user_id   = $user->id;
        $order->total     = $price;
        $order->save();

        if ( $order->payment_id != null && $order->payment_key != null) {
            $payment_key = $order->payment_key;
            $payment_id = $order->payment_id;
        }else{
            list($payment_key , $payment_id) = $this->checkingOut($order->id + 1000);
        }

        $paymentLink = 'https://accept.paymobsolutions.com/api/acceptance/iframes/'. setting("general.payment_iframe_id").'?payment_token='.$payment_key;

        if ($paymentLink) :
            $data = ['link' => $paymentLink];
            return $this->apiResponse($data, 200, 'We are ready to sell');
        endif;

        return $this->apiResponse(null, 520, 'There is an unknown error');
    }

    /***
     * function to convert currency
     */
    public function convertCurrency($price)
    {
        $url = "https://freecurrencyapi.net/api/v2/latest?apikey=d0e1e100-5818-11ec-af91-fb5b698f621f";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        $Price_USD = $price / $response->data->AED;
        $Price_EGP = $Price_USD * $response->data->EGP;

        $endPrice = (float)sprintf('%0.2f', $Price_EGP);
        return $endPrice;
    }


    public function response(Request $request){

        list($paymentStatus , $orderId) = $this->processedCallback($request);

        $order = Order::find($orderId - 1000);
        // dd($request);
        if ($paymentStatus == 'succeeded') :

            $this->createVoucher($order->course_id, $order->user_id, $order->total);

            if (Course::find($order->course_id)->type == 'recorded') :
                $this->takeCourse($order->course_id, $order->user_id);
            elseif (Course::find($order->course_id)->type == 'live') :
                $this->takeLiveCourse($order->course_id, $order->user_id);
            endif;

            return redirect()->to(env('APP_URL').'/course_detiles/'.$order->course->id.'/'.$order->course->slug)->with('success', 'your payment done');
        else:
            return redirect()->to(env('APP_URL').'/course_detiles/'.$order->course->id.'/'.$order->course->slug)->with('error', 'Sorry, your request was not completed');
            // return redirect('/')->with('error', 'Sorry, your request was not completed');
        endif;

    }


    public function processed(Request $request){

       list($paymentStatus , $orderId) = $this->processedCallback($request);
       $order = Order::find($orderId - 1000);

       if ($paymentStatus == 'succeeded') :

            $this->createVoucher($order->course_id, $order->user_id, $order->total);

            if (Course::find($order->course_id)->type == 'recorded') :
                $this->takeCourse($order->course_id, $order->user_id);
            elseif (Course::find($order->course_id)->type == 'live') :
                $this->takeLiveCourse($order->course_id, $order->user_id);
            endif;

            return redirect()->to(env('APP_URL').'/course_detiles/'.$order->course->id.'/'.$order->course->slug)->with('success', 'your payment done');
        else:
            return redirect()->to(env('APP_URL').'/course_detiles/'.$order->course->id.'/'.$order->course->slug)->with('error', 'Sorry, your request was not completed');
            // return redirect('/')->with('error', 'Sorry, your request was not completed');
        endif;

    }


    public function takeCourse($course_id, $user_id = null)
    {
        $user = User::find($user_id) ?? Auth::user();

        /** add user in course accept **/
        $user->courses()->attach($course_id);
        $user->chapters()->attach(Chapter::where('course_id', $course_id)->get());
        $user->lessons()->attach(Lesson::where('course_id', $course_id)->get());

        /** set first lesson as open **/
        // $fLesson = $user->lessons()->where('course_id', $course_id)->first();
        // $user->lessons()->updateExistingPivot($fLesson, array('open' => true), false);

        // /** set first chapter as open **/
        // $fChapter = $user->chapters()->where('course_id', $course_id)->first();
        // $user->chapters()->updateExistingPivot($fChapter, array('open' => true), false);

        // if ($user) :
        //     // return $this->apiResponse(null, 200, 'payment success');
        //     return redirect('/');
        // endif;
    }


    public function takeLiveCourse($course_id, $user_id = null)
    {
        $user = User::find($user_id) ?? Auth::user();

        /** add user in course accept **/
        $user->courses()->attach($course_id);
        $classes = Classes::where('course_id', $course_id)->get();
        $user->classes()->attach($classes);
        $user->classLessons()->attach(ClassLesson::whereIn('class_id', $classes)->get());

        /** set first lesson as open **/
        // $fLesson = $user->classLessons()->whereIn('class_id', $classes)->first();
        // $user->classLessons()->updateExistingPivot($fLesson, array('open' => true), false);

        // /** set first chapter as open **/
        // $fClass = $classes->first();
        // $user->classes()->updateExistingPivot($fClass, array('open' => true), false);

        // if ($user) :
        //     // return $this->apiResponse(null, 200, 'payment success');
        //     return redirect('/');
        // endif;
    }


    public function createVoucher($course_id, $user_id = null, $price)
    {
        $user = User::find($user_id) ?? Auth::user();
        $course = Course::find($course_id);

        Voucher::Create([
            'type' => 'income',
            'amount' => $price,
            'paid_for' => 'paid course ' . $course->name,
            'user_id' => $user->id,
        ]);
    }



}

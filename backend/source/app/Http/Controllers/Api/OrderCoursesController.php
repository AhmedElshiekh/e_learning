<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Chapter;
use App\Models\Classes;
use App\Models\ClassLesson;
use App\Models\Lesson;
use App\Models\Voucher;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;

class OrderCoursesController extends Controller
{

    use ApiResponseTrait;
    private $apiContext;
    private $secret;
    private $clientID;


    public function __construct()
    {
        if (config('paypal.setting.mode') == 'live') :
            $this->clientID = config('paypal.live.client_id');
            $this->secret   = config('paypal.live.client_secret');
        else :
            $this->clientID = config('paypal.sandbox.client_id');
            $this->secret   = config('paypal.sandbox.client_secret');
        endif;


        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $this->clientID,
            $this->secret
        ));

        $this->apiContext->setConfig(config('paypal.setting'));
    }


    // public function payment( $id)
    public function payment($id)
    {

        $user = Auth::user();
        $course = Course::find($id);
        $discount = $course->discountPrice != 0 ? $course->discountPrice : null;
        $price = $this->convertCurrency($discount ?? $course->price);
        // dd($price);

        if (!$price or $course->free) :
            if ($course->type == 'recorded') :
                return $this->takeCourse($course->id, $user->id);
            elseif ($course->type == 'live') :
                return $this->takeLiveCourse($course->id, $user->id);
            endif;
        endif;

        if (!$user) :
            return $this->apiResponse(null, 401, 'You must be a user');

        elseif ($user->courses->contains($course)) :
            return $this->apiResponse(null, 401, 'You own this course');
        endif;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($course->id)
            ->setDescription($user->id)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($price);

        $trans = new Transaction();
        $trans->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Buy the course");

        $redirectUrl = new RedirectUrls();
        $redirectUrl->setReturnUrl(route('api.payment.success'))
            ->setCancelUrl(route('api.payment.cancel'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrl)
            ->setTransactions(array($trans));

        try {
            $payment->create($this->apiContext);
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

        $paymentLink = $payment->getApprovalLink();


        if ($paymentLink) :
            $data = ['link' => $paymentLink];
            return $this->apiResponse($data, 200, 'We are ready to sell');
        endif;

        return $this->apiResponse(null, 520, 'There is an unknown error');

        // return redirect($paymentLink);
    }


    public function cancel()
    {
        return redirect('/')->with('error', 'Your Payment Is Canceled.');
    }


    public function success(Request $request)
    {

        if (empty($request->input('token')) || empty($request->input('PayerID'))) :
            return 'Payment Failed';
        endif;

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $this->apiContext);

        $payerId = $_GET['PayerID'];

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

        if ($result->getState() == 'approved') :

            $trans = $result->transactions;


            foreach ($trans as $t) :
                $items = ($t->item_list->items);
                foreach ($items as $item) :
                    $course_id = $item->name;
                    $user_id = $item->description;
                    $price = $item->price;
                endforeach;
            endforeach;

            $course_id = (int)$course_id;
            $user_id = (int)$user_id;
            $price = (float)$price;

            $this->createVoucher($course_id, $user_id, $price);

            if (Course::find($course_id)->type == 'recorded') :
                return $this->takeCourse($course_id, $user_id);
            elseif (Course::find($course_id)->type == 'live') :
                return $this->takeLiveCourse($course_id, $user_id);
            endif;

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

        if ($user) :
            // return $this->apiResponse(null, 200, 'payment success');
            return redirect('/');
        endif;
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

        if ($user) :
            // return $this->apiResponse(null, 200, 'payment success');
            return redirect('/');
        endif;
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


    /***
     * function to convert currency
     */
    public function convertCurrency($price)
    {
        $url = "https://freecurrencyapi.net/api/v2/latest?apikey=YOUR-APIKEY";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

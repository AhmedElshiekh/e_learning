<?php

namespace App\Http\Traits;

use App\Order;
use Illuminate\Http\Request;
use App\Facades\PaymobFacade;
use App\Models\ProductVariation;

trait PayMobTrait
{


    /**
     * Display checkout page.
     *
     * @param  int  $orderId
     * @return Response
     */
    public function checkingOut($orderId)
    {

        $order = Order::find($orderId - 1000);
        $auth = PaymobFacade::authPaymob(); // login PaymobFacade servers

        if (property_exists($auth, 'detail')) { // login to PayMob attempt failed.
            # code... redirect to previous page with a message.
        }

        $paymobOrder = PaymobFacade::makeOrderPaymob( // make order on PayMob

            $order->total * 100,
            $order->id + 1000,
            $order->user->email,
            $order->user->name,
            $order->user->name,
            $order->user->phone

        );

        // Duplicate order id
        // PayMob saves your order id as a unique id as well as their id as a primary key, thus your order id must not
        // duplicate in their database.
        if (isset($paymobOrder->message)) {
            if ($paymobOrder->message == 'duplicate') {
                # code... your order id is duplicate on PayMob database.
            }
        }

        $paymentKey = PaymobFacade::getPaymentKeyPaymob(
            $order->total * 100,
            $paymobOrder->id,
            $order->user->email,
            $order->user->name,
            $order->user->name,
            $order->user->phone,
            'NA',
            'NA'
        );

        // $payment_key = $paymentKey ? $paymentKey->token :null ;
        $payment_key = $paymentKey->token ;
        // save paymob order id for later usage.
        $payment_id = $paymobOrder->id ;

        $order->payment_key = $payment_key ;
        $order->payment_id = $payment_id ;
        $order->save();

        // dd($payment_key);
        return [$payment_key , $payment_id] ;

    }


    /**
     * Processed callback from Paymob servers.
     * Save the route for this method in Paymob dashboard >> processed callback route.
     *
     * @param  \Illumiante\Http\Request  $request
     * @return  Response
     */
    public function processedCallback($request)
    {
        $orderId = $request->merchant_order_id;
        $order = Order::find($orderId - 1000);

        // Statuses.
        $isPending  = $request->pending;
        $isSuccess  = $request->success;
        $isVoided   = $request->is_voided;
        $isRefunded = $request->is_refunded;
        // dd($isPending , $isSuccess, $isVoided, $isRefunded);

        if ($isSuccess == 'true') :
            $paymentStatus = $this->succeeded($order);       // transaction succeeded.
        // elseif ($isPending == 'true') :
        //     $this->pending($order);         // transaction pending.
        // elseif ($isVoided == 'true' ) :
        //     $this->voided($order);          // transaction voided.
        // elseif ($isRefunded == 'true') :
        //     $this->refunded($order);        // transaction refunded
        else :
            $paymentStatus = $this->failed($order);          // transaction failed.
        endif;
        // return response()->json(['success' => true], 200);
        return [$paymentStatus , $orderId] ;
    }


    /**
     * Transaction succeeded.
     *
     * @param  object  $order
     * @return void
     */
    protected function succeeded($order)
    {
        $order->status = 'succeeded';
        $order->save();
        $paymentStatus = "succeeded";
        return $paymentStatus ;
    }


     /**
     * Transaction failed.
     *
     * @param  object  $order
     * @return void
     */
    protected function failed($order)
    {
        // foreach ($order->products as $product){
        //     $variation = ProductVariation::find($product->pivot->product_variation_id);
        //     $variation->stock += $product->pivot->quantity;
        //     $variation->save();
        // }
        // $order->payment_status = 'failed';
        $order->status = "unCompleted";
        $order->save();
        $paymentStatus = "failed";
        return $paymentStatus ;
    }



    /**
     * Transaction succeeded.
     *
     * @param  object  $order
     * @return void
     */
    protected function pending($order)
    {
        $order->payment_status = 'Declined';
        $order->save();
         echo "pending";
    }


    /**
     * Transaction voided.
     *
     * @param  object  $order
     * @return void
     */
    protected function voided($order)
    {
        # code...
    }

    /**
     * Transaction refunded.
     *
     * @param  object  $order
     * @return void
     */
    protected function refunded($order)
    {
        # code...
    }


    /**
     * Display invoice page (PaymobFacade response callback).
     * Save the route for this method to PaymobFacade dashboard >> response callback route.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function invoice(Request $request)
    {
        # code...
    }

}

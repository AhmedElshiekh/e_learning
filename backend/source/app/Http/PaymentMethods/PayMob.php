<?php

/*
 **************
 * Main Class *
 **************
 */

namespace App\Http\PaymentMethods;

class PayMob
{
    private $iframeId;
    private $integrationId;
    private $token;
    private $merchantId;

    public function __construct()
    {
        $this->iframeId             =   setting('general.payment_iframe_id');
        $this->integrationId        =   setting('general.payment_integration_id');
        $this->api_key              =   setting('general.payment_api_key');
        $this->merchantId           =   setting('general.payment_merchant_id');
        $this->username             =   setting('general.payment_username');
        $this->password             =   setting('general.payment_password');

        $auth = $this->authPaymob();

        if ( $this->token == null or $this->merchantId == null ) {
            if (isset($auth->token)) {

                config([
                    'paymob.merchant_id' => $auth->profile->id,
                ]);

                $this->token = $auth->token;
                $this->merchantId = $auth->profile->id;
            }
        }else{
            if (isset($auth->token)) {
                $this->token = $auth->token;
            }
        }
    }

    public function setIframeId($iframeId)
    {
        $this->iframeId = $iframeId;
    }

    public function setIntegrationId($integrationId)
    {
        $this->integrationId = $integrationId;
    }

    /**
     * Send POST cURL request to paymob servers.
     *
     * @param  string  $url
     * @param  array  $json
     * @return array
     */
    protected function cURL($url, $json)
    {
        // Create curl resource
        $ch = curl_init($url);

        // Request headers
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        // Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $output contains the output string
        $output = curl_exec($ch);

        // Close curl resource to free up system resources
        curl_close($ch);
        return json_decode($output);
    }

    /**
     * Send GET cURL request to paymob servers.
     *
     * @param  string  $url
     * @return array
     */
    protected function GETcURL($url)
    {
        // Create curl resource
        $ch = curl_init($url);

        // Request headers
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        // Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $output contains the output string
        $output = curl_exec($ch);

        // Close curl resource to free up system resources
        curl_close($ch);
        return json_decode($output);
    }

    /**
     * Request auth token from paymob servers.
     *
     * @return array
     */
    public function authPaymob()
    {
        // Request body
        if ( $this->api_key == null ) :
            $json = [
                'username' => $this->username,
                'password' => $this->password
            ];
        else :
            $json = ["api_key" => $this->api_key];
        endif;

        // Send curl
        $auth = $this->cURL(
            'https://accept.paymobsolutions.com/api/auth/tokens',
            $json
        );
        // dd($auth);

        return $auth;
    }

    /**
     * Register order to paymob servers
     *
     * @param  string  $token
     * @param  int  $merchant_id
     * @param  int  $amount_cents
     * @param  int  $merchant_order_id
     * @return array
     */
    public function makeOrderPaymob($amount_cents, $merchant_order_id)
    {
        // Request body
        $json = [
            'merchant_id'            => $this->merchantId,
            'amount_cents'           => $amount_cents,
            'merchant_order_id'      => $merchant_order_id,
            'currency'               => 'EGP',
            'notify_user_with_email' => true
        ];

        // Send curl
        $order = $this->cURL(
            'https://accept.paymobsolutions.com/api/ecommerce/orders?token=' . $this->token,
            $json
        );

        return $order;
    }

    /**
     * Get payment key to load iframe on paymob servers
     *
     * @param  string  $token
     * @param  int  $amount_cents
     * @param  int  $order_id
     * @param  string  $email
     * @param  string  $fname
     * @param  string  $lname
     * @param  int  $phone
     * @param  string  $city
     * @param  string  $country
     * @return array
     */
    public function getPaymentKeyPaymob(
        $amount_cents,
        $order_id,
        $email   = 'NA', //should be required to go live
        $fname   = 'NA', //should be required to go live
        $lname   = 'NA', //should be required to go live
        $phone   = 'NA', //should be required to go live
        $city    = 'NA',
        $country = 'NA'
    ) {
        // Request body
        $json = [
            'amount_cents' => $amount_cents,
            'expiration'   => 18000,
            'order_id'     => $order_id,
            "billing_data" => [
                "email"        => $email,
                "first_name"   => $fname,
                "last_name"    => $lname,
                "phone_number" => $phone,
                "city"         => $city,
                "country"      => $country,
                'street'       => 'NA',
                'building'     => 'NA',
                'floor'        => 'NA',
                'apartment'    => 'NA'
            ],
            'currency'            => 'EGP',
            'card_integration_id' => $this->integrationId
        ];

        // Send curl
        $payment_key = $this->cURL(
            'https://accept.paymobsolutions.com/api/acceptance/payment_keys?token=' . $this->token,
            $json
        );

        return $payment_key;
    }

    /**
     * Make payment for API (moblie clients).
     *
     * @param  string  $token
     * @param  int  $card_number
     * @param  string  $card_holdername
     * @param  int  $card_expiry_mm
     * @param  int  $card_expiry_yy
     * @param  int  $card_cvn
     * @param  int  $order_id
     * @param  string  $firstname
     * @param  string  $lastname
     * @param  string  $email
     * @param  string  $phone
     * @return array
     */
    public function makePayment(
        $payment_token,
        $card_number,
        $card_holdername,
        $card_expiry_mm,
        $card_expiry_yy,
        $card_cvn,
        $order_id,
        $firstname,
        // $lastname ='NA',
        $email,
        $phone
    ) {
        $lastname = 'NA';
        // JSON body.
        $json = [
            'source' => [
                'identifier'        => $card_number,
                'sourceholder_name' => $card_holdername,
                'subtype'           => 'CARD',
                'expiry_month'      => $card_expiry_mm,
                'expiry_year'       => $card_expiry_yy,
                'cvn'               => $card_cvn
            ],
            'billing' => [
                'first_name'   => $firstname,
                'last_name'    => $lastname,
                'email'        => $email,
                'phone_number' => $phone,
            ],
            'payment_token' => $payment_token
        ];

        // Send curl
        $payment = $this->cURL(
            'https://accept.paymobsolutions.com/api/acceptance/payments/pay',
            $json
        );

        return $payment;
    }

    /**
     * Capture authed order.
     *
     * @param  string  $token
     * @param  int  $transactionId
     * @param  int  amount
     * @return array
     */
    public function capture($transactionId, $amount)
    {
        // JSON body.
        $json = [
            'transaction_id' => $transactionId,
            'amount_cents'   => $amount
        ];

        // Send curl.
        $res = $this->cURL(
            'https://accept.paymobsolutions.com/api/acceptance/capture?token=' . $this->token,
            $json
        );

        return $res;
    }

    /**
     * Get PayMob all orders.
     *
     * @param  string  $page
     * @return Response
     */
    public function getOrders($page = 1)
    {
        $orders = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/ecommerce/orders?page={$page}&token=" . $this->token
        );

        return $orders;
    }

    /**
     * Get PayMob order.
     *
     * @param  int  $orderId
     * @return Response
     */
    public function getOrder($orderId)
    {
        $order = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/ecommerce/orders/{$orderId}?token=" . $this->token
        );

        return $order;
    }

    /**
     * Get PayMob all transactions.
     *
     * @param  string  $page
     * @return Response
     */
    public function getTransactions($page = 1)
    {
        $transactions = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/acceptance/transactions?page={$page}&token=" . $this->token
        );

        return $transactions;
    }

    /**
     * Get PayMob transaction.
     *
     * @param  int  $transactionId
     * @return Response
     */
    public function getTransaction($transactionId)
    {
        $transaction = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/acceptance/transactions/{$transactionId}?token=" . $this->token
        );

        return $transaction;
    }

    /**
     * Get PayMob pay url.
     *
     * @param  int  $order_id
     * @return Response
     */
    public function getPayUrl($order_id, $amount_cents = null, $email = 'NA', $fname = 'NA', $lname = 'NA', $phone = 'NA', $city = 'NA', $country = 'NA')
    {
        if (!$amount_cents) {
            $order = $this->getOrder($order_id);
            if (!isset($order->amount_cents)) return NULL;
            $amount_cents = $order->amount_cents;
        }
        $payment_key = $this->getPaymentKeyPaymob($amount_cents, $order_id, $email, $fname, $lname, $phone, $city, $country);
        return (isset($payment_key->token)) ? $this->payment_url($payment_key->token) : NULL;
    }

    /**
     * Get PayMob pay url.
     *
     * @param  int  $iframeId
     * @return Response
     */
    public function payment_url($payment_token)
    {
        return "https://accept.paymobsolutions.com/api/acceptance/iframes/" . $this->iframeId . "?payment_token={$payment_token}";
    }


}

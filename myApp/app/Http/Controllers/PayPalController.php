<?php

namespace App\Http\Controllers;

use App\Models\Enrollement;
use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class PayPalController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try {
            $response = $this->gateway->purchase([
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('user.payment.success'),
                'cancelUrl' => route('user.payment.cancel'),
            ])->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {

        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ]);

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();

                // store transaction info in payment table in our database
                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->payment_method = 'PayPal';
                $payment->save();

                // store enrollement info 
                // CourseController::enroll();

                return "Payment is Successfull. Your transaction ID is : " . $arr['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return "Payment declined !!";
        }
    }


    public function cancel()
    {
        return "User declined the payment!!";
    }
}

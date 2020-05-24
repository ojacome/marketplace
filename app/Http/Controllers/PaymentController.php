<?php

namespace App\Http\Controllers;

use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;
    private $payPalConfig;

    public function __construct(){
        $this->payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->payPalConfig['client_id'],     // ClientID
                $this->payPalConfig['secret']      // ClientSecret
            )
        );
    }

    public function payWithPayPal(){
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal(auth()->user()->cart->calcularTotal());
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Pago de carrito de compras');

        $callbackUrl = url('/paypal/status');        
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        
        try {
            $payment->create($this->apiContext);
            //echo $payment;          
            
            return redirect()->away($payment->getApprovalLink());
            // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        }
        catch (PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            //echo $ex->getData();

            return redirect('/paypal/status');
        }
    }

    public function payPalStatus(Request $request){

        // dd($request->all());

        $paymentId = $request->input('paymentId');
        $token = $request->input('token');
        $payer = $request->input('PayerID');

        if(!$paymentId || !$token || !$payer){
            $payStatus = 'No se pudo proceder con el pago a traves de Paypal (cancelado por usuario)';
            return redirect('/home')->with(compact('payStatus'));
        }


        try{
            $payment = Payment::get($paymentId, $this->apiContext);
    
            $execution = new PaymentExecution();
            $execution->setPayerId($payer);
    
            $result = $payment->execute($execution, $this->apiContext);
            $state = $result->getState();

            //update cart 
            $cart = auth()->user()->cart;
            $cart->status = 'Pending';
            $cart->total = $cart->calcularTotal();
            $cart->save();

            // dd($result);

            $payStatus = $this->mensajeState($state);
            
            if($state !== 'approved'){ 
                            
                return redirect('/home')->with(compact('payStatus'));
            }

            
            return redirect('/order')->with(compact('payStatus'));


        }catch(Exception $ex){
            return redirect('/home')->with(compact('ex'));
        }        

    }

    public function mensajeState($state){

        $msg = '';

        switch($state){
            case('created'):
                $msg = $this->payPalConfig['msgState']['created'];  
            break;
            case('approved'):
                $msg = $this->payPalConfig['msgState']['approved'];  
            break;
            case('failed'):
                $msg = $this->payPalConfig['msgState']['failed'];  
            break;
            default:
                $msg = $this->payPalConfig['msgState']['unknown'];                  
        }

        return $msg;
    }
}

<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends BaseController {

    private $_api_context;

    public function __construct() {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment() {


        $name = 'Transaction';
      
        /*$mmnumber      = Input::get('number');
        $amounttosend     = Input::get('amount');
        $currency   = Input::get('currency');*/

        $mmnumber      = Input::get('number');
        $amounttosend     = Input::get('amount');
        $currency   = Input::get('currency');

        $charges = new PlatformCharges($amounttosend, $currency);


    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $item_1 = new Item();
    $item_1->setName('Transaction') // item name
	        ->setCurrency('USD')
	        ->setQuantity(1)
	        ->setPrice((int)$charges->getDueAmountForPayPalToMobileMoney()); // unit price

	// add item to list
    $item_list = new ItemList();
    $item_list->setItems(array($item_1));

    $amount = new Amount();
    $amount->setCurrency('USD')
           ->setTotal((int)$charges->getDueAmountForPayPalToMobileMoney());

    $transaction = new Transaction();
    $transaction->setAmount($amount)
		        ->setItemList($item_list)
		        ->setDescription('Send money To a Mobile Money User');

    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl(URL::route('payment-status'))
		          ->setCancelUrl(URL::route('payment-status'));

    $payment = new Payment();
    $payment->setIntent('sale')
	        ->setPayer($payer)
	        ->setRedirectUrls($redirect_urls)
	        ->setTransactions(array($transaction));

	try {
        $payment->create($this->_api_context);
    } catch (\PayPal\Exception\PPConnectionException $ex) {
        if (\Config::get('app.debug')) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            $err_data = json_decode($ex->getData(), true);
            exit;
        } else {
            die('Some error occurred, sorry for inconvenient');
        }
    }

    foreach($payment->getLinks() as $link) {
        if($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
            break;
        }
    }

    // add payment ID to session
    Session::put('paypal_payment_id', $payment->getId());

    if(isset($redirect_url)) {
        // redirect to paypal
        return Redirect::away($redirect_url);
    }

    return  "Error!!!!";/*Redirect::route('original.route')
        ->with('error', 'Unknown error occurred'); */

    }


    public function getPaymentStatus() {
    // Get the payment ID before session clear
    $payment_id = Session::get('paypal_payment_id');

    // clear the session payment ID
    Session::forget('paypal_payment_id');

    /*if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        return Redirect::route('original.route')
            ->with('error', 'Payment failed');
    }
    */
    // Get the Payer id and token
    $payer_id = Input::get('PayerID');
    $token = Input::get('token');
    // If any of the two is empty, payment was not made
    if (empty($payer_id) || empty($token)) 
    {
        return Redirect::route('dashboard')
                        ->with('alertError', 'Transaction aborted');
    }

    $payment = Payment::get($payment_id, $this->_api_context);

    // PaymentExecution object includes information necessary 
    // to execute a PayPal account payment. 
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId(Input::get('PayerID'));

    //Execute the payment
    $result = $payment->execute($execution, $this->_api_context);

    /*return Redirect::route('dashboard')
                        ->with('alertMessage', 'Transaction Successful');
                        */
        $transaction_json  = json_decode($result->getTransactions()[0], TRUE);
        $payer['email'] = $result->getPayer()->getPayerInfo()->getEmail();
        $payer['phone'] = $result->getPayer()->getPayerInfo()->getPhone();
        $payer['name'] = $result->getPayer()->getPayerInfo()->getFirstName().$result->getPayer()->getPayerInfo()->getLastName()
        .$result->getPayer()->getPayerInfo()->getMiddleName();
        $add = 'USD';

        $transaction = new IcePayTransaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->tid = $result->getId();
        $transaction->sender_email = $payer['email'];
        $transaction->receiver_email = 'icepay@gmail.com';
        $transaction->type = $transaction_json['related_resources'][0]['sale']['payment_mode'];
        $transaction->status = $transaction_json['related_resources'][0]['sale']['state'];
        $transaction->amount = $transaction_json['amount']['total'] . $add;
        $transaction->save();

        return Redirect::route('dashboard')
                        ->with('alertMessage', 'Transaction Successful');

    /*echo 'Payment ID = '.$result->getId().' <br/>';
    print_r($payer);echo '<br/>';
    echo '<pre> Amount = '.$transaction_json['amount']['total'].'<br/>Type = '
        .$transaction_json['related_resources'][0]['sale']['payment_mode']. 
    '<br/>status = '.$transaction_json['related_resources'][0]['sale']['state'].'</pre>';exit;
    */
   // echo '<pre>';var_dump($result->transactions[0]);echo '</pre>';exit; // DEBUG RESULT, remove it later


    if ($result->getState() == 'approved') { // payment made
        return Redirect::route('original.route')
            ->with('success', 'Payment success');
    }
    return "Error!!!";/*Redirect::route('original.route')
        ->with('error', 'Payment failed'); */
    }

    //function to simulate mobile money
    public function postTransfer(){
        $email      = Input::get('email');
        $amounttosend     = Input::get('amount');
        $transaction_id       = str_random(10);
        $add = 'FCFA';

        $transaction = new IcePayTransaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->tid = $transaction_id;
        $transaction->sender_email = User::find(Auth::user()->id)->number;
        $transaction->receiver_email = $email;
        $transaction->type = 'MM_TRANSFER';
        $transaction->status = 'completed';
        $transaction->amount = $amounttosend . $add;
        $transaction->save();

        return Redirect::route('dashboard')
                        ->with('alertMessage', 'Transaction Successful');
    }

    public function viewTransaction(){

       // $user = User::find(Auth::user()->id);
        $user = User::find(Auth::user()->id);
       /* $transactions = IcePayTransaction::find(Auth::user()->id);
        $t = &$transactions;

       // return var_dump($transactions);

        return $transactions != NULL? View::make('site.transaction')
                    ->with('user', $user)
                    ->with('transactions', $transactions->all())
                    ->with('title', 'IcePay - Dashboard')
                    :
                    View::make('site.transaction')
                    ->with('user', $user)
                    ->with('transactions', $t)
                    ->with('title', 'IcePay - Dashboard')
                    ;
                    */
        $data['user'] = User::find(Auth::user()->id);
        $data['transactions'] = IcePayTransaction::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return View::make('site.transaction')->with($data)->with('title', 'IcePay - Dashboard - Transactions');
    }
}
class PlatformCharges{

    private $currency;
    private $amount;
    private $charge;

    //initialize platform charges
    public function __construct($amount, $currency){
        $this->currency = $currency;
        $this->amount = $this->convertCurrency($currency, 'USD', $amount);
    }

    //TODO:: Tarrifs here need to be revised and match the actual charge tarrifs
    public function getDueAmountForPayPalToMobileMoney(){
            
                if($this->amount >= 5.0 && $this->amount <= 10.0 ){ //free of charge
                    return $this->amount ;    
                }else if($this->amount > 10.0 && $this->amount <= 20.0 ){ //
                    return $this->amount + (0.01 * $this->amount);    
                }else if($this->amount > 20.0 && $this->amount <= 50.0 ){ //
                    return $this->amount + (0.03 * $this->amount);    
                }else if($this->amount > 50.0 && $this->amount <= 100.0 ){ //
                    return $this->amount + (0.05 * $this->amount);    
                }else if($this->amount > 100.0 && $this->amount <= 200.0 ){ //
                    return $this->amount + (0.08 * $this->amount);   
                }else if($this->amount > 200.0 && $this->amount <= 500.0 ){ //
                    return $this->amount + (0.15 * $this->amount);    
                }else{
                    return $this->amount + (0.20 * $this->amount) ; //charge 1/8 of the transfer sum
                }
    }

    public function getDueAmountForMobileMoneyToPayPal(){

    }

    public function convertCurrency($fromCurrency, $toCurrency, $amount){
         if($fromCurrency == $toCurrency ){
                return $amount;
            }

         if($fromCurrency == 'USD' && $toCurrency == 'EUR'){
               return $amount * 0.90 ;
            }else if($fromCurrency == 'EUR' && $toCurrency == 'USD'){
                return $amount / 0.90 ;
                
            }else if($fromCurrency == 'GBP' && $toCurrency == 'USD'){
                return $amount * 1.51 ;
            
            }else if($fromCurrency == 'USD' && $toCurrency == 'GBP'){
                return $amount / 1.51 ;
            
            }else if($fromCurrency == 'XAF' && $toCurrency == 'USD'){
                return $amount / 588.86 ;
            
            }else if($fromCurrency == 'USD' && $toCurrency == 'XAF'){
                return $amount * 588.86 ;
            
            }else if($fromCurrency == 'EUR' && $toCurrency == 'XAF'){
                return $amount / 655.66 ;
            }
            else
                return $amount;
    }

}
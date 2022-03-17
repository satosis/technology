<?php

namespace App\Services;

use URL;
use Config;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Rest\ApiContext;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use Illuminate\Http\Request;
use App\Models\Payment as Pay;
use PayPal\Api\PaymentExecution;
use App\Services\PaypayServices;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;

class PaypalServices
{
    public function __construct()
    { 
        $paypal_conf = Config::get('env');
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            )
        );
    }  

    public function paypalTransaction(Request $request){ 
            $money = $request->amount;  
            $payer = new Payer();
            $payer->setPaymentMethod('paypal'); 
            $item_1 = new Item();  
            $item_1->setName('Donate') /** item name **/
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($money/2 ); /** unit price **/
    
            $item_2 = new Item(); 
            $item_2->setName('Donate') /** item name **/
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($money/2 ); /** unit price **/
            $item_list = new ItemList();
            $item_list->setItems(array($item_1, $item_2)); 
            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($money);
    
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('');
    
            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::to('/')) /** Specify return URL **/
                ->setCancelUrl(URL::to('/'));
    
            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            try {
                $payment->create($this->apiContext);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (Config::get('app.debug')) {
                    \Session::flash('toastr',[
                        'type'      =>'error',
                        'message'   =>'Quá thời gian kết nối'
                    ]);
                    return '/';
                } else {
                    \Session::flash('toastr',[
                        'type'      =>'error',
                        'message'   =>'Đã xảy ra lỗi ,xin lỗi vì sự bất tiện này'
                    ]);
                    return '/';
                }
            }
           
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    return $link->getHref();
                }
            }
           
        }
}

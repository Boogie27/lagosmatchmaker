<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paystack extends Model
{
    use HasFactory;

    






    public function __construct()
    {
       
    }



    public static function get_paystack_key()
    {
      $settings =  DB::table('settings')->where('id', 1)->first();
       return $settings->is_paystack_activate ? $settings->paystack_live_key : $settings->paystack_test_key;
    }

    
    // INITIATE PAYSTACK PAYMENT 
    public static function initialize($email, $amount, $url)
    {
        $curl = curl_init();

        // $email = "example@email.com";
        // $amount = 300000;  //the amount in kobo. This value is actually NGN 300
        
        // url to go to after payment
        // $callback_url = 'myapp.com/pay/callback.php';  
        $callback_url =   $url;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode([
            'amount'=> $amount.'00',
            'email'=> $email,
            'callback_url' => $callback_url
          ]),
          CURLOPT_HTTPHEADER => [
            "authorization: Bearer ".self::get_paystack_key(), //replace this with your own test key
            "content-type: application/json",
            "cache-control: no-cache"
          ],
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        if($err){
          // there was an error contacting the Paystack API
          die('Curl returned error: ' . $err);
        }
        
        $tranx = json_decode($response, true);
        
        if(!$tranx['status']){
          // there was an error from the API
          print_r('API returned error: ' . $tranx['message']);
        }
        
        // comment out this line if you want to redirect the user to the payment page
        // print_r($tranx);
        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        // header('Location: ' . $tranx['data']['authorization_url']);   
         return  $tranx['data']['authorization_url'];
    }







    // PAYSTACK CALL_BACK 
    public static function call_back()
    {
        $curl = curl_init();
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        if(!$reference){
        die('No reference supplied');
        }
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Bearer ".$this->_paymentKey,
            "cache-control: no-cache"
        ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            // there was an error contacting the Paystack API
        die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response);

        if(!$tranx->status){
        // there was an error from the API
        die('API returned error: ' . $tranx->message);
        }

        if('success' == $tranx->data->status){
        // transaction was successful...
        // please check other things like whether you already gave value for this ref
        // if the email matches the customer who owns the product etc
        // Give value
           return $reference;
        }
    }

    // end

}


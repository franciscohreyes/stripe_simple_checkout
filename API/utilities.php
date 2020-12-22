<?php

require_once('config.php');

/**
 * create a token card
 * @return string token
 */
function generateToken($cardNumber, $month, $year, $cvc){
    $stripe = new \Stripe\StripeClient('YOUR_KEY_SECRET');
    
    $token = $stripe->tokens->create([
        'card' => [
          'number' => $cardNumber,
          'exp_month' => $month,
          'exp_year' => $year,
          'cvc' => $cvc,
        ]
    ]);

    if($token){
        return $token['id'];
    } else {
        return false;
    }
}
?>
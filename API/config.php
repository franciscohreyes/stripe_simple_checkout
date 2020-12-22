<?php
require '../vendor/autoload.php';

/**
 * init Stripe
 * API KEY
 */
\Stripe\Stripe::setApiKey('YOUR_KEY_SECRET');

$stripe = new \Stripe\StripeClient('YOUR_KEY_SECRET');
?>
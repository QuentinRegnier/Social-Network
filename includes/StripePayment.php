<?php
require_once('../vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51OFgHvEixYJXc5MWjAO4KfUHQUa8oYqfmaxHHyWYdGHTmntSdJRezzTsfDsIlldR0MGcTWGeVqMjAhtKMe1fSD3d00DhNcp689');

if ($_POST['action'] == 'create-checkout-session') {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card', 'ideal', 'link', 'paypal'],
        'line_items' => [[
            'price' => 'price_1OQvjuEixYJXc5MWyUP7r0QJ',
            'quantity' => 1,
        ]],
        'mode' => 'subscription',
        'locale' => 'fr',
        'customer_email' => 'quentin.regnier17@gmail.com',
        'success_url' => 'https://votre_site.com/success',
        'cancel_url' => 'https://votre_site.com/cancel',
        'automatic_tax' => [
		    	'enabled' => true
		],
        'allow_promotion_codes' => true,
        'billing_address_collection' => 'required',
        'subscription_data' => [
            'trial_period_days' => 14
        ]
    ]);

    header("Location: " . $session->url, true, 303);
    exit();
}
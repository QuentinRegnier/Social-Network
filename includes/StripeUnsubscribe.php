<?php
require_once('../vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51OFgHvEixYJXc5MWjAO4KfUHQUa8oYqfmaxHHyWYdGHTmntSdJRezzTsfDsIlldR0MGcTWGeVqMjAhtKMe1fSD3d00DhNcp689');
$subscriptionId = 'sub_1OQvzEEixYJXc5MW7uevTcpm';
try {
    $subscription = \Stripe\Subscription::retrieve($subscriptionId);
    $subscription->cancel();
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Erreur lors de l\'annulation de l\'abonnement : ', $e->getMessage();
}
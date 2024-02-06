<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('votre_clé_api_stripe');

$payload = @file_get_contents('php://input');
$event = null;

try {
    $event = \Stripe\Event::constructFrom(
        json_decode($payload, true)
    );
} catch(\UnexpectedValueException $e) {
    // Log ou gestion d'erreur
    http_response_code(400);
    exit();
}

// Gérer l'événement
switch ($event->type) {
    case 'checkout.session.completed':
        $session = $event->data->object;

        // Traiter les informations de la session
        // Exemple : enregistrer les données de paiement dans une base de données
        break;
    // ajouter d'autres cas si nécessaire
}

http_response_code(200);
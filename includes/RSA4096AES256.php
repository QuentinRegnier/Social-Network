<?php
require '../vendor/autoload.php';

use phpseclib3\Crypt\AES;
use phpseclib3\Exception\NoKeyLoadedException;

function Decrypt($encryptedString)
{
    // Convertir la chaîne JSON en tableau PHP
    $input = json_decode($encryptedString, true);
    // Initialiser GnuPG
    putenv('GNUPGHOME=/var/www/.gnupg'); // Assurez-vous que ce chemin est correct pour l'utilisateur www-data
    $gpg = new gnupg();
    // Supprimer les caractères d'échappement devant les caractères spéciaux
    $input['cleAES'] = stripcslashes($input['cleAES']);
    // Importer la clé privée et la passphrase
    // Ceci est un exemple et devrait être fait en dehors du script avec une gestion sécurisée des clés
    $privateKey = file_get_contents('/var/www/html/keys/private-key.asc');
    $keyInfo = $gpg->import($privateKey);
    $gpg->adddecryptkey($keyInfo['fingerprint'], 'Maelyskeoz17quentin!'); // Remplacer par votre passphrase réelle
    
    // Décrypter la clé AES cryptée avec RSA
    $cleAESDecrypteeHex = $gpg->decrypt($input['cleAES']);
    $cleAESDecrypteeBin = hex2bin($cleAESDecrypteeHex);
    // Décrypter les données avec AES
    $aes = new \phpseclib3\Crypt\AES('cbc');
    $aes->setKey($cleAESDecrypteeBin);
    $aes->setIV(hex2bin($input['iv']));
    $donneesDecryptees = $aes->decrypt(base64_decode($input['donnees']));
    if ($donneesDecryptees === false) {
        throw new Exception("Décryptage des données échoué.");
    }

    // Renvoyer les données décryptées
    return $donneesDecryptees;
}
function removeFirstAndLastChar($string) {
    return substr($string, 1, -1);
}
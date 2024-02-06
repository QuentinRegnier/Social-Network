<?php
// require $predisloc;
// Predis\Autoloader::register();
// use Predis\Client;
// ini_set('default_socket_timeout', -1);
// $redis = new Predis\Client([
//     'scheme' => 'tcp',
//     'host'   => '127.0.0.1',
//     'port'   => 6379,
// ]);
$redis = new Redis([
    'host' => '127.0.0.1',
    'port' => 6379,
    'connectTimeout' => 2.5,
    'auth' => ['phpredis', 'phpredis'],
    'ssl' => ['verify_peer' => false],
    'backoff' => [
        'algorithm' => Redis::BACKOFF_ALGORITHM_DECORRELATED_JITTER,
        'base' => 500,
        'cap' => 750,
    ],
]);
$redis->setOption (Redis:: OPT_READ_TIMEOUT, -1);
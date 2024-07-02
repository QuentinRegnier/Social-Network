<?php
$predisloc = '../predis-2.2.1/autoload.php';
include 'predis.php';
$channelName = 'sse_5Lrc22xuc5LJ57hv7Y3k6E2DGk7hMzR37K7E237t6NNyS44uUAvYfqD9H8yG2Y6kAUzyau';
$redis->subscribe(array('sse_5Lrc22xuc5LJ57hv7Y3k6E2DGk7hMzR37K7E237t6NNyS44uUAvYfqD9H8yG2Y6kAUzyau', 'sse'), 'psubscribe');
function psubscribe($redis, $pattern, $chan, $msg) {
      echo "Pattern: $pattern\n";
      echo "Channel: $chan\n";
      echo "Payload: $msg\n";
}
// function handleMessage($message) {
//     $messageData = json_decode($message);
//     echo "data: " . json_encode($messageData) . "\n\n";
//     exit;
// }
// // while (true) {
// //     $redis->subscribe($channelName, function ($message) {
// //         handleMessage($message);
// //     });
// // }
// $handler = function ($message) {
//     handleMessage($message);
// };

// $redis->getProfile()->defineCommand('subscribe_one', 'Predis\Command\PubSubSubscribe');

// $redis->subscribe_one([$channelName], $handler);
// echo "data:" . $redis->get($channelName);
?>

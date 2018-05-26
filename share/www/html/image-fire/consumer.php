<?php

require_once 'autoload.php';

use Mangasf\ImageFire\Application\Service\QueuesConsumeMessage;
use Mangasf\ImageFire\Domain\Entity\Message;
use Mangasf\ImageFire\Infrastructure\ImageTools\GumletImageProcessor;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\StorageImageElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\StorageImageMysql;
use Mangasf\ImageFire\Infrastructure\Repositories\Redis\StorageImageRedis;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('processes', false, true, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg){

    $storageRepoMysql = new StorageImageMysql();
    $storageRepoRedis = new StorageImageRedis();
    $storageRepoElastic = new StorageImageElastic();

    $imageProcessor = new GumletImageProcessor();

    $queuesConsumeMessage = new QueuesConsumeMessage(
        $imageProcessor,
        $storageRepoMysql,
        $storageRepoRedis,
        $storageRepoElastic
    );

    $decode_msg = json_decode($msg->body, true);
    $action = $decode_msg['action'];
    $src_image = $decode_msg['src_image'];
    $dist_image = $decode_msg['dist_image'];

    $message = new Message($action, $src_image, $dist_image);
    $queuesConsumeMessage($message);
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('processes', '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();
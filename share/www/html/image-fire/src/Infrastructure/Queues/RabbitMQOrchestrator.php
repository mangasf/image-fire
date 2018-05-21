<?php

namespace Mangasf\ImageFire\Infrastructure\Queues;

use Mangasf\ImageFire\Domain\Queues\QueuesOrchestrator;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMQOrchestrator implements QueuesOrchestrator
{
    private $connection;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    }

    public function publishMessage($queue, $message): void
    {
        $channel = $this->connection->channel();
        $channel->queue_declare($queue, false, true, false, false);

        $msg = new AMQPMessage(json_encode($message),
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );
        $channel->basic_publish($msg, '', $queue);
        $channel->close();
    }

    public function closeConnection(): void
    {
        $this->connection->close();
    }
}
<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\Queues\QueuesOrchestrator;

final class QueuesPublishMessage
{
    private $queuesOrchestrator;

    public function __construct(QueuesOrchestrator $queuesOrchestrator)
    {
        $this->queuesOrchestrator = $queuesOrchestrator;
    }

    public function __invoke($queue, $message)
    {
        $this->queuesOrchestrator->publishMessage($queue, $message);
    }
}
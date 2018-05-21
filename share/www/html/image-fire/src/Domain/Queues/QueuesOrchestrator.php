<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Queues;

interface QueuesOrchestrator
{
    public function publishMessage($queue, $message): void;
}
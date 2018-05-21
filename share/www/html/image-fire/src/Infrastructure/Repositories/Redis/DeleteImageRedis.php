<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Redis;

use Mangasf\ImageFire\Domain\Repositories\DeleteImageRepository;
use Predis\Client;

final class DeleteImageRedis implements DeleteImageRepository
{
    protected $redisClient;

    public function __construct()
    {
        $this->redisClient = new Client();
    }

    public function deleteImage(string $imageId)
    {
        $this->redisClient->hdel($imageId, ['name', 'contain', 'description', 'tags']);
    }
}
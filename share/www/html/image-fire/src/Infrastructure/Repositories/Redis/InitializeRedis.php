<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Redis;

use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\InitializeRepo;
use Predis\Client;

final class InitializeRedis implements InitializeRepo
{
    protected $redisClient;

    public function __construct()
    {
        $this->redisClient = new Client();
    }

    public function initializeRepo(Image ...$images)
    {
        foreach ($images as $image) {

            $imageId  = $image->getId();
            $imageName = $image->getName();
            $imageContain = $image->getContain();
            $imageDesc = $image->getDescription();
            $imageTags = $image->getTags();

            $this->redisClient->hset($imageId, "name", $imageName);
            $this->redisClient->hset($imageId, "contain", $imageContain);
            $this->redisClient->hset($imageId, "description", $imageDesc);
            $this->redisClient->hset($imageId, "tags", $imageTags);
        }
    }
}
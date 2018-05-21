<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Redis;

use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\ListImagesRepository;
use Predis\Client;

final class ListImagesRedis implements ListImagesRepository
{
    protected $redisClient;

    public function __construct()
    {
        $this->redisClient = new Client();
    }

    public function getAllImages(): array
    {
        $images = [];
        $keys = $this->redisClient->keys('*');

        foreach ($keys as $key) {
            $redisImage = $this->redisClient->hgetall($key);
            $image = new Image(
                $key,
                $redisImage['name'],
                $redisImage['contain'],
                $redisImage['description'],
                $redisImage['tags']
            );
            array_push($images, $image);
        }

        return $images;
    }
}
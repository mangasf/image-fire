<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Elastic;

use Elasticsearch\ClientBuilder;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\StorageImageRepository;

final class StorageImageElastic implements StorageImageRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    public function storageImage(Image $image)
    {
        $params = [
            'index' => 'image_fire',
            'type' => 'my_type',
            'id' => $image->getId(),
            'body' => [
                'name' => $image->getName(),
                'description' => $image->getDescription(),
                'tags' => $image->getTags()
            ]
        ];

        $this->client->index($params);
    }
}
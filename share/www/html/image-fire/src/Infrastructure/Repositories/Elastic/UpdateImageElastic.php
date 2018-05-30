<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Elastic;

use Elasticsearch\ClientBuilder;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\UpdateImageRepository;

final class UpdateImageElastic implements UpdateImageRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    public function updateImage(Image $image)
    {
        $params = [
            'index' => 'image_fire',
            'type' => 'my_type',
            'id' => $image->getId(),
            'body' => [
                'doc' => [
                    'name' => $image->getName(),
                    'description' => $image->getDescription(),
                    'tags' => $image->getTags()
                ]
            ]
        ];

        $this->client->update($params);
    }
}
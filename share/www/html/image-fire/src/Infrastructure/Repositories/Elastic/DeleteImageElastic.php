<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Elastic;

use Elasticsearch\ClientBuilder;
use Mangasf\ImageFire\Domain\Repositories\DeleteImageRepository;

final class DeleteImageElastic implements DeleteImageRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    public function deleteImage(string $imageId)
    {
        $params = [
            'index' => 'image_fire',
            'type' => 'my_type',
            'id' => $imageId
        ];

        $this->client->delete($params);
    }
}
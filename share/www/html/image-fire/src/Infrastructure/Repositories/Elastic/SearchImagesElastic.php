<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Elastic;

use Elasticsearch\ClientBuilder;
use Mangasf\ImageFire\Domain\Repositories\ListImagesRepository;

class SearchImagesElastic implements ListImagesRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    public function getAllImages(): array
    {

    }
}
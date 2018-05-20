<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Elastic;

use Elasticsearch\ClientBuilder;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\SearchImageRepository;

class SearchImagesElastic implements SearchImageRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    public function searchImages(string $searchCriterials): array
    {
        $images = [];

        $params = [
            'index' => 'image_fire',
            'type' => 'my_type',
            'body' => [
                'query' => [
                    'match' => [
                        'tags' => $searchCriterials
                    ]
                ]
            ]
        ];

        $results = $this->client->search($params);
        $docs   = $results['hits']['hits'];

        foreach ($docs as $doc) {
            $id = $doc['_id'];
            $name = $doc['_source']['name'];
            $contain = $doc['_source']['contain'];
            $description = $doc['_source']['description'];
            $tags = $doc['_source']['tags'];
            $image = new Image($id, $name, $contain, $description, $tags);
            array_push($images, $image);
        }

        return $images;
    }
}
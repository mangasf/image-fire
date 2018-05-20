<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\Redis;

use Exception;
use Mangasf\ImageFire\Domain\Repositories\ListImagesRepository;
use Predis\Client;

final class ListImagesRedis implements ListImagesRepository{

    protected $redis;

    public function __construct()
    {
        try {
            $this->redis = new Client();
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getAllImages(): array
    {

    }
}
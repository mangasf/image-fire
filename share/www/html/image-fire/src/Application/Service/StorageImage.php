<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\StorageImageRepository;
use PDOException;

final class StorageImage
{
    private $repoImageInserter;

    public function __construct(StorageImageRepository $repoImageInserter)
    {
        $this->repoImageInserter = $repoImageInserter;
    }

    public function __invoke(Image $image)
    {
        try {
            $this->repoImageInserter->storageImage($image);
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }
}
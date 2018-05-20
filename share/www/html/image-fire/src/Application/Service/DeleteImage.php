<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\Repositories\DeleteImageRepository;
use PDOException;

final class DeleteImage
{
    private $repoImageRemover;

    public function __construct(DeleteImageRepository $repoImageRemover)
    {
        $this->repoImageRemover = $repoImageRemover;
    }

    public function __invoke(string $imageId)
    {
        try {
            $this->repoImageRemover->deleteImage($imageId);
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }
}
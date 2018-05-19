<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\UpdateImageRepository;
use PDOException;

final class UpdateImage
{
    private $repoImageUpdater;

    public function __construct(UpdateImageRepository $repoImageUpdater)
    {
        $this->repoImageUpdater = $repoImageUpdater;
    }

    public function __invoke(Image $image)
    {
        try {
            $this->repoImageUpdater->updateImage($image);
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }
}
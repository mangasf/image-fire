<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\Repositories\ListImagesRepository;
use PDOException;

final class ListImages
{
    private $repoImagesLister;

    public function __construct(ListImagesRepository $repoImagesLister)
    {
        $this->repoImagesLister = $repoImagesLister;
    }

    public function __invoke(): array
    {
        $images = [];

        try {
            $images = $this->repoImagesLister->getAllImages();
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $images;
    }
}
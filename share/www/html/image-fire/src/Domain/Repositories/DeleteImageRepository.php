<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Repositories;

interface DeleteImageRepository
{
    public function deleteImage(string $imageId);
}
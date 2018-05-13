<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Repositories;

use Mangasf\ImageFire\Domain\Models\Image;

interface StorageImageRepository
{
    public function storageImage(Image $image);
}